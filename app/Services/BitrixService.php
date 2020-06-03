<?php


namespace App\Services;

use Exception;
use Mail;
use App\City;
use Illuminate\Support\Facades\Session;

class BitrixService
{

    // Сюда добавляются ID ответственных через запятую. Должен быть как минимум 1 ID
    private $arr_responsible_id = [1447]; //Мурыга Милана

    public function __construct()
    {
    }

    public function sendContactForm($data)
    {
        $data = json_decode($data, true);

        if ($data['phone'] == null || strlen((string)$data['phone']) < 11) {
            throw new Exception();
        }

        $data['name'] = isset($data['name']) ? htmlspecialchars(strip_tags($data['name']), ENT_QUOTES) : '';
        $data['phone'] =  isset($data['phone']) ? strip_tags($data['phone']) : '';
        $data['responsible_id'] = isset($data['responsible_id']) ? intval($data['responsible_id']) : '';
        $data['comment'] = isset($data['comment']) ? htmlspecialchars(strip_tags($data['comment']), ENT_QUOTES) : '';
        $data['form_id'] = isset($data['form_id']) ? htmlspecialchars(strip_tags($data['form_id']), ENT_QUOTES) : '';
        $data['city'] = isset($data['city']) ? htmlspecialchars(strip_tags($data['city']), ENT_QUOTES) : '';
        $data['caption'] = isset($data['caption']) ? htmlspecialchars(strip_tags($data['caption']), ENT_QUOTES) : '';
        $data['form_type'] = isset($data['form_type']) ? intval($data['form_type']) : '';

        $phone = $data['phone'];
        $responsible_id = $data['responsible_id'];

        $request = [
            'type' => "PHONE",
            'values' => [$phone],
        ];

        $city = City::where('alias', $data['city'])->get();

        if (!$city) {
            throw new Exception();
        }

        $emailFrom = 'site@brightpark.ru';

        $emailsTo = 'ivanopol777@mail.ru,';
        if ($data['form_type'] === 1) {
            $emailsTo .= $city[0]->callback_emails;
        } elseif ($data['form_type'] === 2) {
            $emailsTo .= $city[0]->callback_service_emails;
        }

        $subject = 'Брайт Парк. Заявка с сайта ';

        $params['name'] = isset($data['name']) ? $data['name'] : '';
        $params['phone'] = isset($data['phone']) ? $data['phone'] : '';
        $params['city'] = isset($city[0]->title_ru) ? $city[0]->title_ru : '';
        $params['caption'] = isset($data['caption']) ? $data['caption'] : '';
        $params['comment'] = isset($data['comment']) ? $data['comment'] : '';
        $params['url'] = isset($data['url']['href']) ? $data['url']['href'] : '';

        if (isset($data['url']) && empty($data['url']['search'])) {
            if (Session::has('utmcuidF2y0seW')) {
                $params['url'] .= '?';
                foreach (['utm_campaign', 'utm_content', 'utm_medium', 'utm_source', 'utm_term'] as $label) {
                    if (Session::has('utmcuidF2y0seW.' . $label ))
                    {
                        $params['url'] .= '&' . $label . '=' . session('utmcuidF2y0seW.' .$label);
                    }
                }
            }
        }

        Mail::send('emails.feedback', $params, function($message) use ($emailsTo, $emailFrom, $subject) {
            $emails = explode(',', $emailsTo);

            foreach ($emails as $key => $email) {
                if (!$key) {
                    $message->to($email)->subject($subject)->from($emailFrom, 'Брайт Парк');
                } else {
                    $message->cc($email)->subject($subject)->from($emailFrom, 'Брайт Парк');
                }
            }
        });

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://team.brightpark.ru/rest/610/g1iski89ajvio040/crm.duplicate.findbycomm.json',
            CURLOPT_POSTFIELDS => http_build_query($request),
        ]);

        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, 1);

        if (!empty($result['result'])) {
            if (!empty($result['result']["CONTACT"])) {
                $info = 'Добавлено дело #ID_JOB# к контакту #ID_SUSH#';
                $count = count($result['result']["CONTACT"]) - 1;
                $id = $result['result']["CONTACT"][$count];
                $type = 3;
                $crm_method = 'contact';
            } elseif (!empty($result['result']["COMPANY"])) {
                $info = 'Добавлено дело #ID_JOB# к компании #ID_SUSH#';
                $count = count($result['result']["COMPANY"]) - 1;
                $id = $result['result']["COMPANY"][$count];
                $type = 4;
                $crm_method = 'company';
            } elseif (!empty($result['result']["LEAD"])) {
                $info = 'Добавлено дело #ID_JOB# к лиду #ID_SUSH#';
                $count = count($result['result']["LEAD"]) - 1;
                $id = $result['result']["LEAD"][$count];
                $type = 1;
                $crm_method = 'lead';
            }
            // Выбираем ID ответственного за сущность (Контакт, Компания, Лид)
            $request = [
                'id' => $id,
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_POST => 1,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => "https://team.brightpark.ru/rest/610/g1iski89ajvio040/crm.{$crm_method}.get.json",
                CURLOPT_POSTFIELDS => http_build_query($request),
            ]);

            $result = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($result, 1);

            $responsible_id = $result['result']["ASSIGNED_BY_ID"];

        } else {
            $info = 'Создан новый лид #ID_SUSH# и к нему прикреплено дело #ID_JOB#';

            // Добавление лида
            $request = [
                'fields' => [
                    "TITLE" => 'Test lid', //название формы на сайте
                    "STATUS_ID" => "NEW",
                    "OPENED" => "Y",
                    "ASSIGNED_BY_ID" => $responsible_id,
                    "UF_CRM_1471411617" => '3755', // источник=lada-rostov.ru
                    "SOURCE_ID" => "SELF",
                    "NAME" => $data['name'], //имя из поля
                    "PHONE" => [["VALUE" => $phone, "VALUE_TYPE" => "MOBILE"]],
                ],
                'params' => ["REGISTER_SONET_EVENT" => "Y"],
            ];

           if (Session::has('utmcuidF2y0seW')) {
                foreach (['utm_campaign', 'utm_content', 'utm_medium', 'utm_source', 'utm_term'] as $label) {
                    if (Session::has('utmcuidF2y0seW.' . $label ))
                    {
                         $request['fields'][strtoupper($label)] = session('utmcuidF2y0seW.' .$label);
                    }
                }
            }

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_POST => 1,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://team.brightpark.ru/rest/610/g1iski89ajvio040/crm.lead.add.json',
                CURLOPT_POSTFIELDS => http_build_query($request),
            ]);

            $result = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($result, 1);

            $id = $result['result'];
            $type = 1;
        }

        // Прикрепление дела
        $request = [
            'fields' => [
                'OWNER_ID' => $id, //ID Сущности: лид/контакт/компания
                'OWNER_TYPE_ID' => $type, //1 лид, 3 контакт, 4 компания
                'TYPE_ID' => 2,
                'COMMUNICATIONS' => [['VALUE' => $phone]],
                'SUBJECT' => 'Заявка с сайта!',
                // 'START_TIME' => date('Y-m-d H:i:s'),
                'END_TIME' => date('Y-m-d H:i:s'),
                'COMPLETED' => 'N',
                'PRIORITY' => 3,
                'RESPONSIBLE_ID' => $responsible_id, //ответственный
                'DESCRIPTION' => 'Важный звонок',
                'DESCRIPTION_TYPE' => 1,
                'DIRECTION' => 2, //Тип звонка: 0 без данных, 1 Входящее, 2 Исходящее
            ],
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://team.brightpark.ru/rest/610/g1iski89ajvio040/crm.activity.add.json',
            CURLOPT_POSTFIELDS => http_build_query($request),
        ]);
        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($result, 1);

        // ставим куку, если еще не ставили
        $key = 'cuidF2y0seW';

        if (!isset($_COOKIE[$key])) {

            $value = base64_encode(json_encode([
                'owner_id' => $id,   // ID Сущности: лид/контакт/компания
                'owner_type_id' => $type, // 1 лид, 3 контакт, 4 компания
                'last_visit' => time(),
            ]));

            setcookie($key, $value, time() + 60 * 60 * 24 * 365, '/');
        }
    }

    function getUrl()
    {
        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $_SERVER['REQUEST_URI']
        );
    }

    function checkVisitorCookie()
    {
        $key = 'cuidF2y0seW';

        $utm = [];

        foreach (['utm_campaign', 'utm_content', 'utm_medium', 'utm_source', 'utm_term'] as $label) {
            if (isset($_GET[$label]) && is_scalar($_GET[$label])) {
                $utm[$label] = mb_substr($_GET[$label], 0, 255);
            }
        }

        if (!isset($_SESSION['utm' . $key])) {
            $_SESSION['utm' . $key] = [];
        }

        $_SESSION['utm' . $key] = array_merge($_SESSION['utm' . $key], $utm);

        if (isset($_COOKIE[$key])) {
            $now = time();
            $gap = 60 * 60 * 24;
            $cookie = json_decode(base64_decode($_COOKIE[$key]), true);

            if (!isset($cookie['pages'])) {
                $cookie['pages'] = [];
            }

            array_unshift($cookie['pages'], $_SERVER['REQUEST_URI']);
            $cookie['pages'] = array_slice($cookie['pages'], 0, 20);

            if (!isset($cookie['last_visit']) || isset($cookie['last_visit']) && $cookie['last_visit'] + $gap < $now) {
                $cookie['last_visit'] = $now;


                $curl = curl_init();

                $request = [
                    'id' => $cookie['owner_id'],
                ];

                curl_setopt_array($curl, [
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_POST => 1,
                    CURLOPT_HEADER => 0,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://team.brightpark.ru/rest/610/g1iski89ajvio040/crm.lead.get.json',
                    CURLOPT_POSTFIELDS => http_build_query($request),
                ]);

                $result = curl_exec($curl);
                curl_close($curl);
                $result = json_decode($result, 1);

                $lead = $result['result'];


                if (!empty($lead) && !empty($lead['PHONE'][0]['VALUE'])) {
                    // Прикрепление дела
                    $request = [
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
                            'DESCRIPTION' => 'Звонок кроту!<br>Последние просмотренные страницы:<br>'.implode('; ', $cookie['pages'])
                        ],
                    ];

                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_POST => 1,
                        CURLOPT_HEADER => 0,
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'https://team.brightpark.ru/rest/610/g1iski89ajvio040/crm.activity.add.json',
                        CURLOPT_POSTFIELDS => http_build_query($request),
                    ]);
                    curl_exec($curl);
                    curl_close($curl);
                }
            }

            $cookie = base64_encode(json_encode($cookie));
            setcookie($key, $cookie, time() + 60 * 60 * 24 * 365, '/');
        }
    }
}
