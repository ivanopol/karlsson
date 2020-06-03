<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckUTM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = 'cuidF2y0seW';

        if (!Session::has('utm' . $key))
        {
            Session::put('utm' . $key, []);
        }

        foreach (['utm_campaign', 'utm_content', 'utm_medium', 'utm_source', 'utm_term'] as $label) {
            if (isset($_GET[$label]) && is_scalar($_GET[$label])) {
                Session::put('utm' . $key . '.' . $label, mb_substr($_GET[$label], 0, 255) );
            }
        }

        if (isset($_COOKIE[$key])) {
            $now = time();
            $gap = 60 * 60 * 24;
            $cookie = json_decode(base64_decode($_COOKIE[$key]), true);
            $report = '';

            if (!isset($cookie['pages'])) {
                $cookie['pages'] = [];
            }

            array_unshift($cookie['pages'], $_SERVER['REQUEST_URI']);
            $cookie['pages'] = array_slice($cookie['pages'], 0, 20);


            if (!isset($cookie['last_visit']) || isset($cookie['last_visit']) && $cookie['last_visit'] + $gap < $now) {

                $cookie['last_visit'] = $now;

                $report .= 'Содержимое куки:<br><pre>' . print_r($cookie, true) . '</pre><br><br>';

                $curl = curl_init();

                $request_crm = [
                    'id' => $cookie['owner_id'],
                ];

                curl_setopt_array($curl, [
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_POST           => 1,
                    CURLOPT_HEADER         => 0,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL            => 'https://team.brightpark.ru/rest/610/g1iski89ajvio040/crm.lead.get.json',
                    CURLOPT_POSTFIELDS     => http_build_query($request_crm),
                ]);

                $result = curl_exec($curl);
                curl_close($curl);
                $result = json_decode($result, 1);
                $lead = $result['result'];



                $report .= 'Поиск лида по идентификатору:<br><pre>Запрос: ' . print_r($request_crm, true) . '</pre><br><pre>Ответ: ' . print_r($result, true) . '</pre><br><br>';

                if (!empty($lead) && !empty($lead['PHONE'][0]['VALUE'])) {
                    // Прикрепление дела
                    $request_crm = [
                        'fields' => [
                            'OWNER_ID' => $cookie['owner_id'], //ID Сущности: лид/контакт/компания
                            'OWNER_TYPE_ID' => $cookie['owner_type_id'], //1 лид, 3 контакт, 4 компания
                            'TYPE_ID' => 2,
                            'COMMUNICATIONS' => [['VALUE' => $lead['PHONE'][0]['VALUE']]],
                            'SUBJECT' => 'Звонок кроту!',
                            // 'START_TIME' => date('Y-m-d H:i:s'),
                            'END_TIME' => date('Y-m-d H:i:s'),
                            'COMPLETED' => 'N',
                            'PRIORITY' => 3,
                            'RESPONSIBLE_ID' => $lead['ASSIGNED_BY_ID'], //ответственный
                            'DESCRIPTION_TYPE' => 1,
                            'DIRECTION' => 2, //Тип звонка: 0 без данных, 1 Входящее, 2 Исходящее
                            'DESCRIPTION' => 'Звонок кроту!<br>Последние просмотренные страницы:<br>' . implode('; ', $cookie['pages'])
                        ],
                    ];

                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_POST => 1,
                        CURLOPT_HEADER => 0,
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'https://team.brightpark.ru/rest/610/g1iski89ajvio040/crm.activity.add.json',
                        CURLOPT_POSTFIELDS => http_build_query($request_crm),
                    ]);
                    $result = curl_exec($curl);
                    curl_close($curl);
                    $result = json_decode($result, 1);

                    $report .= 'Создание активности:<br><pre>Запрос: ' . print_r($request_crm, true) . '</pre><br><pre>Ответ: ' . print_r($result, true) . '</pre><br><br>';
                }
            }

            $cookieDomain = !empty($session_cookie_domain) ? $session_cookie_domain : '';
            $secure  = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http';
            $cookie = base64_encode(json_encode($cookie));
            setcookie($key, $cookie, time() + 60*60*24*365, "/", $cookieDomain, $secure, true);
        }

        return $next($request);
    }
}
