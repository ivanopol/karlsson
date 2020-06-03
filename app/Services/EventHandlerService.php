<?php


namespace App\Services;

use Illuminate\Support\Facades\Redis;

class EventHandlerService
{
    private $redis;

    public function __construct(Redis $r)
    {
        $this->redis = $r::connection();
    }

    public function handle_event($content)
    {
        $type = $content->event_type;

        switch ($type) {
            case 'button':
                $this->handle_button_event($content);
                break;
            case 'scroll':
                $this->handle_scroll_event($content);
                break;
            case "visit":
                $this->handle_visit_event($content);
        }
    }

    /**
     * @param $content
     */
    private function handle_button_event($content): void
    {
        $event = [
            'location' => $content->location,
            'href' => $content->href,
            'btn_id' => $content->btn_id,
            'user_ip' => $_SERVER['REMOTE_ADDR'],
            'timestamp' => date("Y-m-d H:i:s"),
            'bp_uid' => $this->get_cookie_uid()
        ];

        $this->redis->set('btn_event_' . base64_encode($_SERVER['REMOTE_ADDR']
                . '_' . $content->btn_id . '_' . date("Y-m-d H:i:s")),
            json_encode($event));
    }

    /**
     * @param $content
     */
    private function handle_scroll_event($content): void
    {
        $event = [
            'location' => $content->location,
            'position' => $content->position,
            'previous_position' => $content->previous_position,
            'user_ip' => $_SERVER['REMOTE_ADDR'],
            'timestamp' => date("Y-m-d H:i:s"),
            'page_height' => $content->page_height,
            'bp_uid' => $this->get_cookie_uid()
        ];

        $this->redis->set('scroll_event_' . base64_encode($_SERVER['REMOTE_ADDR']
                . '_' . $content->position . '_' . date("Y-m-d H:i:s")), json_encode($event));
    }

    /**
     * @param $content
     */
    private function handle_visit_event($content): void
    {
        $event = [
            'location' => $content->location,
            'bp_uid' => $content->bp_uid,
            'timestamp' => date("Y-m-d H:i:s"),
        ];

        $this->redis->set('visit_event_' . base64_encode($content->user_ip
                . '_' . $content->bp_uid . '_' . date("Y-m-d H:i:s")), json_encode($event));
    }

    private function get_cookie_uid()
    {
        $cookie = $_COOKIE['bp_uuid'];
        return json_decode(base64_decode($cookie))->bp_uid;
    }
}
