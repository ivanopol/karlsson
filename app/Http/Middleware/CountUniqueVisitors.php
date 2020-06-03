<?php


namespace App\Http\Middleware;

use App\Services\EventHandlerService;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

/**
 * @property EventHandlerService event_handler_service
 * @property \Illuminate\Database\Connection|\Illuminate\Database\ConnectionInterface db
 */
class CountUniqueVisitors
{
    public function __construct(EventHandlerService $eventHandlerService)
    {
        $this->event_handler_service = $eventHandlerService;
        $this->db = DB::connection();
    }

    function handle($request, Closure $next)
    {
        $today = date('Y-m-d');
        $redis = Redis::connection();

        if (!isset($_COOKIE['bp_uuid'])) {

            $cookie = [
                'user_ip' => $_SERVER['REMOTE_ADDR'],
                'bp_uid' => uniqid("bpark_", true),
                'date' => $today
            ];

            setcookie('bp_uuid', base64_encode(json_encode($cookie)), time() + 60 * 60 * 24 * 365, '/');

            $cookie = json_decode(json_encode($cookie));

            $this->set_yandex_uid($cookie);

            $this->create_visitor($cookie);

            if ($redis->exists($today)) {
                $redis->incr($today);
            } else {
                $redis->set($today, 1);
            }

        } else {
            $cookie_date = json_decode(base64_decode($_COOKIE['bp_uuid']))->date;

            if ($redis->exists($today) && $cookie_date != $today) {
                $redis->incr($today);
            } else {
                $redis->set($today, 1);
            }

            $cookie = json_decode(base64_decode($_COOKIE['bp_uuid']));

            $this->set_yandex_uid($cookie);

            $cookie->date = $today;

            setcookie('bp_uuid', base64_encode(json_encode($cookie)), time() + 60 * 60 * 24 * 365, '/');

            $this->create_visitor($cookie);
        }

        $cookie->location = $_SERVER['REQUEST_URI'];
        $cookie->event_type = 'visit';

        $this->send_event($cookie);

        return $next($request);
    }

    private function send_event($payload)
    {
        $this->event_handler_service->handle_event($payload);
    }

    private function create_visitor($visitor_data)
    {
        $user_data = [
            '_ym_uid' => $visitor_data->_ym_uid,
            'yandex_i' => $visitor_data->yandex_i,
            'yandexuid' => $visitor_data->yandexuid,
            'user_ip' => $visitor_data->user_ip,
            'bp_uid' => $visitor_data->bp_uid,
            'created_at' => date("Y-m-d H:i:s")
        ];

        $visitor = $this->db->table('visitors')->where('bp_uid', '=', $user_data['bp_uid'])->first();

        if ($visitor == null) {
            $this->db->table('visitors')->insert($user_data);
        } else {
            $this->db->table('visitors')->where('bp_uid', '=', $user_data['bp_uid'])->update(
                [
                    '_ym_uid' => $user_data['_ym_uid'],
                    'yandex_i' => $user_data['yandex_i'],
                    'yandexuid' => $user_data['yandexuid'],
                ]
            );
        }
    }
    /**
     * @param $cookie
     * @return void
     */
    public function set_yandex_uid($cookie)
    {
        try {
            $cookie->_ym_uid = $_COOKIE['_ym_uid'];
        } catch (\Exception $ex) {
            $cookie->_ym_uid = "";
        }

        try {
            $cookie->yandex_i = $_COOKIE['i'];
        } catch (\Exception $ex) {
            $cookie->yandex_i = "";
        }

        try {
            $cookie->yandexuid = $_COOKIE['yandexuid'];
        } catch (\Exception $ex) {
            $cookie->yandexuid = "";
        }
    }
}
