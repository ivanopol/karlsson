<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    public function run()
    {
        $open_script = '<!-- Yandex.Metrika counter -->
<script type="application/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(60182227, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/60182227" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->';

        $end_script = "";

        $cities = [
            ['title_ru' => 'Пермь', 'title_en' => 'perm', 'alias' => 'perm', 'city_dative' => 'Перми', 'coordinates' => '57.997388, 56.306636', 'jivosite_token'=>'IFmL6hf3c9', 'open_script'=>$open_script, 'bitrix_responsible_id' => 1447,
                'begin_script' => $end_script,
                'callback_emails' => 'info@brightpark.ru,erc@brightpark.ru',
                'callback_service_emails' => 'service@brightpark.ru',
            ],
            ['title_ru' => 'Москва', 'title_en' => 'moscow', 'alias' => 'moscow', 'city_dative' => 'Москве', 'coordinates' => '55.488305, 37.565856', 'open_script'=>$open_script, 'jivosite_token'=>'IFmL6hf3c9', 'bitrix_responsible_id' => 1447,
                'begin_script' => $end_script,
                'callback_emails' => 'moscow@brightpark.ru, erc@brightpark.ru',
                'callback_service_emails' => 'service.moscow@brightpark.ru',
            ],
            ['title_ru' => 'Магнитогорск', 'title_en' => 'magnitogorsk', 'alias' => 'magnitogorsk', 'city_dative' => 'Магнитогорске', 'coordinates' => '53.342167, 58.996030', 'jivosite_token'=>'IFmL6hf3c9', 'open_script'=>$open_script, 'bitrix_responsible_id' => 1447,
                'begin_script' => $end_script,
                'callback_emails' => 'magnitka@brightpark.ru,erc@brightpark.ru',
                'callback_service_emails' => 'service.magnitka@brightpark.ru',
            ],
            ['title_ru' => 'Ростов-на-Дону', 'title_en' => 'rostov-on-don', 'alias' => 'rostov-na-donu', 'city_dative' => 'Ростове-на-Дону', 'coordinates' => '47.220273, 39.686051', 'jivosite_token'=>'IFmL6hf3c9', 'open_script'=>$open_script, 'bitrix_responsible_id' => 1447,
                'begin_script' => $end_script,
                'callback_emails' => 'rostov@brightpark.ru,erc@brightpark.ru',
                'callback_service_emails' => 'service.rnd@brightpark.ru',
            ],
            ['title_ru' => 'Екатеринбург', 'title_en' => 'ekaterinburg', 'alias' => 'yekaterinburg', 'city_dative' => 'Екатеринбурге', 'coordinates' => '56.885092, 60.534520', 'jivosite_token'=>'IFmL6hf3c9', 'open_script'=>$open_script, 'bitrix_responsible_id' => 1447,
                'begin_script' => $end_script,
                'callback_emails' => 'ekb@brightpark.ru,erc@brightpark.ru',
                'callback_service_emails' => 'service.ekb@brightpark.ru',
            ],
            ['title_ru' => 'Волгоград', 'title_en' => 'volgograd', 'alias' => 'volgograd', 'city_dative' => 'Волгограде', 'coordinates' => '48.644535, 44.429039', 'jivosite_token'=>'IFmL6hf3c9', 'open_script'=>$open_script, 'bitrix_responsible_id' => 1447,
                'begin_script' => $end_script,
                'callback_emails' => 'volga@brightpark.ru,erc@brightpark.ru',
                'callback_service_emails' => 'service.volga.@brightpark.ru',
            ],
        ];

        DB::table('cities')->insert($cities);
    }
}
