<?php


use Illuminate\Database\Seeder;

class ReviewTableSeeder extends Seeder
{
    public function run()
    {
/*        'quote' => 'Выгодно отличается от конкурентов ценой и изначальной приспособленностью к российским условиям эксплуатации.
Еще одно наблюдение – благодаря высокому клиренсу проехать по колее и выбраться из нее можно без особых проблем, если только она не проложена военным «Уралом» или T-72.
Надежный двигатель, японский «автомат», хороший дорожный просвет делают Lada Granta серьезным конкурентом на автомобильном рынке.',*/

        $reviews = [
            // Granta
            //sedan
            [
                'model_id' => 1,
                'type_id' => 1,
                'url' => 'https://www.kolesa.ru/article/krasivee-khetchbeka-i-ne-khuzhe-universala-vse-dostupnye-liftbeki-rossiyskogo-rynka',
                'quote' => 'Granta попадает чуть ли не в каждую вторую подборку: самые дешевые автомобили с автоматом – да, седаны с самым большим дорожным просветом – да, седаны с самым большим багажником – снова да! ',
                'author' => 'портал <cite>КОЛЕСА.ру</cite>'
            ],
            [
                'model_id' => 1,
                'type_id' => 1,
                'url' => 'https://www.zr.ru/content/articles/917943-5-povodov-zadumatsya-o-pokupke-lada-granta-cross/ ',
                'quote' => 'На ней смело можно съезжать с асфальта, не боясь повредить днище о какой-нибудь камушек ',
                'author' => 'портал <cite>zr.ru</cite>'
            ],
            [
                'model_id' => 1,
                'type_id' => 1,
                'url' => 'https://www.kolesa.ru/article/pyat-veshhej-za-kotorye-lyubyat-i-nenavidyat-lada-granta ',
                'quote' => 'Если вы выбираете фирменный сервис, то Гранта обойдётся вам в сумму куда меньшую, чем абсолютное большинство современных автомобилей.',
                'author' => 'портал <cite>КОЛЕСА.ру</cite>'
            ],
            [
                'model_id' => 1,
                'type_id' => 1,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazgr/vazgra970.htm ',
                'quote' => 'Выгодно отличается от конкурентов ценой и изначальной приспособленностью к российским условиям эксплуатации.',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],

            // liftback
            [
                'model_id' => 1,
                'type_id' => 2,
                'url' => 'https://www.kolesa.ru/article/krasivee-khetchbeka-i-ne-khuzhe-universala-vse-dostupnye-liftbeki-rossiyskogo-rynka',
                'quote' => 'Granta попадает чуть ли не в каждую вторую подборку: самые дешевые автомобили с автоматом – да, седаны с самым большим дорожным просветом – да, седаны с самым большим багажником – снова да! ',
                'author' => 'портал <cite>КОЛЕСА.ру</cite>'
            ],
            [
                'model_id' => 1,
                'type_id' => 2,
                'url' => 'https://www.zr.ru/content/articles/917943-5-povodov-zadumatsya-o-pokupke-lada-granta-cross/ ',
                'quote' => 'На ней смело можно съезжать с асфальта, не боясь повредить днище о какой-нибудь камушек ',
                'author' => 'портал <cite>zr.ru</cite>'
            ],
            [
                'model_id' => 1,
                'type_id' => 2,
                'url' => 'https://www.kolesa.ru/article/pyat-veshhej-za-kotorye-lyubyat-i-nenavidyat-lada-granta ',
                'quote' => 'Если вы выбираете фирменный сервис, то Гранта обойдётся вам в сумму куда меньшую, чем абсолютное большинство современных автомобилей.',
                'author' => 'портал <cite>КОЛЕСА.ру</cite>'
            ],
            [
                'model_id' => 1,
                'type_id' => 2,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazgr/vazgra970.htm ',
                'quote' => 'Выгодно отличается от конкурентов ценой и изначальной приспособленностью к российским условиям эксплуатации.',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],
            // Granta
            // Cross
            [
                'model_id' => 1,
                'type_id' => 4,
                'url' => 'https://www.kolesa.ru/article/krasivee-khetchbeka-i-ne-khuzhe-universala-vse-dostupnye-liftbeki-rossiyskogo-rynka',
                'quote' => 'Granta попадает чуть ли не в каждую вторую подборку: самые дешевые автомобили с автоматом – да, седаны с самым большим дорожным просветом – да, седаны с самым большим багажником – снова да! ',
                'author' => 'портал <cite>КОЛЕСА.ру</cite>'
            ],
            [
                'model_id' => 1,
                'type_id' => 4,
                'url' => 'https://www.zr.ru/content/articles/917943-5-povodov-zadumatsya-o-pokupke-lada-granta-cross/ ',
                'quote' => 'На ней смело можно съезжать с асфальта, не боясь повредить днище о какой-нибудь камушек ',
                'author' => 'портал <cite>zr.ru</cite>'
            ],
            [
                'model_id' => 1,
                'type_id' => 4,
                'url' => 'https://www.kolesa.ru/article/pyat-veshhej-za-kotorye-lyubyat-i-nenavidyat-lada-granta ',
                'quote' => 'Если вы выбираете фирменный сервис, то Гранта обойдётся вам в сумму куда меньшую, чем абсолютное большинство современных автомобилей.',
                'author' => 'портал <cite>КОЛЕСА.ру</cite>'
            ],
            [
                'model_id' => 1,
                'type_id' => 4,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazgr/vazgra970.htm ',
                'quote' => 'Выгодно отличается от конкурентов ценой и изначальной приспособленностью к российским условиям эксплуатации.',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],
            // Vesta
            // sedan
            [
                'model_id' => 2,
                'type_id' => 1,
                'url' => 'https://autodraiv2020.ru/2019/12/31/lada-vesta-s-yaponskim-motorom-i-variatorom/',
                'quote' => 'От управления «Вестой» можно по-настоящему получить удовольствие. Без шуток.
Автомобиль буквально проглатывает ямы, атакуя одну связку поворотов за другой.
Просторно, удобные кресла и неплохой акустический комфорт. ',
                'author' => 'портал <cite>autodraiv2020.ru</cite>'
            ],
            [
                'model_id' => 2,
                'type_id' => 1,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazve_wj/aa-trade21.htm',
                'quote' => 'В богатых комплектациях LADA Vesta SW Cross по оснащению существенно превосходит своих конкурентов.
Еще один плюс LADA Vesta – большое количество модификаций: в модельном ряду есть седаны и универсалы, как с обычным, так и с увеличенным дорожным просветом, а также уникальное предложение в сегменте – версия на газовом топливе.',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],
            [
                'model_id' => 2,
                'type_id' => 1,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazve_wj/vazvea950.htm',
                'quote' => 'Дизайн без всяких сомнений заслуживает оценки “отлично”.
С такой внешностью автомобиль не затеряется и на парковке с автомобилями премиального класса.
Столь грамотно спроектированного багажного отсека, как у LADA Vesta SW Cross мы не встречали даже у иномарок. Здесь все продумано до мелочей. ',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],
            // 4x4
            // 3 doors
            [
                'model_id' => 4,
                'type_id' => 11,
                'url' => 'https://www.zr.ru/content/articles/921576-obnovlennaya-lada-4kh4-2020/ ',
                'quote' => 'О качестве дороги, сидя за рулем Lada 4x4, можно особенно не задумываться благодаря штатной металлической защите моторного отсека.
За что страна гордится Нивой, так это за ее сумасшедшую проходимость. ',
                'author' => 'портал <cite>zr.ru</cite>'
            ],
            // XRAY
            // CROSS
            [
                'model_id' => 3,
                'type_id' => 4,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazxr/vazxra01.htm ',
                'quote' => 'Приборная панель LADA XRAY ультраспортивна – словно это гоночный автомобиль. Стильная бело-зеленая шкала приборов, чёткие стрелки – ничего лишнего. 
Зато багажнику LAD XRAY может позавидовать практически любой компактный кроссовер.',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],
            // XRAY
            // XRAY
            [
                'model_id' => 3,
                'type_id' => 20,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazxr/vazxra01.htm ',
                'quote' => 'Приборная панель LADA XRAY ультраспортивна – словно это гоночный автомобиль. Стильная бело-зеленая шкала приборов, чёткие стрелки – ничего лишнего. 
Зато багажнику LAD XRAY может позавидовать практически любой компактный кроссовер.',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],
            // Granta
            //drive active
            [
                'model_id' => 1,
                'type_id' => 5,
                'url' => 'https://www.kolesa.ru/article/krasivee-khetchbeka-i-ne-khuzhe-universala-vse-dostupnye-liftbeki-rossiyskogo-rynka',
                'quote' => 'Granta попадает чуть ли не в каждую вторую подборку: самые дешевые автомобили с автоматом – да, седаны с самым большим дорожным просветом – да, седаны с самым большим багажником – снова да! ',
                'author' => 'портал <cite>КОЛЕСА.ру</cite>'
            ],
            [
                'model_id' => 1,
                'type_id' => 5,
                'url' => 'https://www.zr.ru/content/articles/917943-5-povodov-zadumatsya-o-pokupke-lada-granta-cross/ ',
                'quote' => 'На ней смело можно съезжать с асфальта, не боясь повредить днище о какой-нибудь камушек ',
                'author' => 'портал <cite>zr.ru</cite>'
            ],
            [
                'model_id' => 1,
                'type_id' => 5,
                'url' => 'https://www.kolesa.ru/article/pyat-veshhej-za-kotorye-lyubyat-i-nenavidyat-lada-granta ',
                'quote' => 'Если вы выбираете фирменный сервис, то Гранта обойдётся вам в сумму куда меньшую, чем абсолютное большинство современных автомобилей.',
                'author' => 'портал <cite>КОЛЕСА.ру</cite>'
            ],
            [
                'model_id' => 1,
                'type_id' => 5,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazgr/vazgra970.htm ',
                'quote' => 'Выгодно отличается от конкурентов ценой и изначальной приспособленностью к российским условиям эксплуатации.
Еще одно наблюдение – благодаря высокому клиренсу проехать по колее и выбраться из нее можно без особых проблем, если только она не проложена военным «Уралом» или T-72.
Надежный двигатель, японский «автомат», хороший дорожный просвет делают Lada Granta серьезным конкурентом на автомобильном рынке.',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],

            // Vesta
            // SW
            [
                'model_id' => 2,
                'type_id' => 7,
                'url' => 'https://autodraiv2020.ru/2019/12/31/lada-vesta-s-yaponskim-motorom-i-variatorom/',
                'quote' => 'От управления «Вестой» можно по-настоящему получить удовольствие. Без шуток.
Автомобиль буквально проглатывает ямы, атакуя одну связку поворотов за другой.
Просторно, удобные кресла и неплохой акустический комфорт. ',
                'author' => 'портал <cite>autodraiv2020.ru</cite>'
            ],
            [
                'model_id' => 2,
                'type_id' => 7,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazve_wj/aa-trade21.htm',
                'quote' => 'В богатых комплектациях LADA Vesta SW Cross по оснащению существенно превосходит своих конкурентов.
Еще один плюс LADA Vesta – большое количество модификаций: в модельном ряду есть седаны и универсалы, как с обычным, так и с увеличенным дорожным просветом, а также уникальное предложение в сегменте – версия на газовом топливе.',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],
            [
                'model_id' => 2,
                'type_id' => 7,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazve_wj/vazvea950.htm',
                'quote' => 'Дизайн без всяких сомнений заслуживает оценки “отлично”.
С такой внешностью автомобиль не затеряется и на парковке с автомобилями премиального класса.
Столь грамотно спроектированного багажного отсека, как у LADA Vesta SW Cross мы не встречали даже у иномарок. Здесь все продумано до мелочей. ',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],
            // Vesta
            // SW
            [
                'model_id' => 2,
                'type_id' => 4,
                'url' => 'https://autodraiv2020.ru/2019/12/31/lada-vesta-s-yaponskim-motorom-i-variatorom/',
                'quote' => 'От управления «Вестой» можно по-настоящему получить удовольствие. Без шуток.
Автомобиль буквально проглатывает ямы, атакуя одну связку поворотов за другой.
Просторно, удобные кресла и неплохой акустический комфорт. ',
                'author' => 'портал <cite>autodraiv2020.ru</cite>'
            ],
            [
                'model_id' => 2,
                'type_id' => 4,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazve_wj/aa-trade21.htm',
                'quote' => 'В богатых комплектациях LADA Vesta SW Cross по оснащению существенно превосходит своих конкурентов.
Еще один плюс LADA Vesta – большое количество модификаций: в модельном ряду есть седаны и универсалы, как с обычным, так и с увеличенным дорожным просветом, а также уникальное предложение в сегменте – версия на газовом топливе.',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],
            [
                'model_id' => 2,
                'type_id' => 4,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazve_wj/vazvea950.htm',
                'quote' => 'Дизайн без всяких сомнений заслуживает оценки “отлично”.
С такой внешностью автомобиль не затеряется и на парковке с автомобилями премиального класса.
Столь грамотно спроектированного багажного отсека, как у LADA Vesta SW Cross мы не встречали даже у иномарок. Здесь все продумано до мелочей. ',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],

            // Vesta
            // SW CROSS
            [
                'model_id' => 2,
                'type_id' => 8,
                'url' => 'https://autodraiv2020.ru/2019/12/31/lada-vesta-s-yaponskim-motorom-i-variatorom/',
                'quote' => 'От управления «Вестой» можно по-настоящему получить удовольствие. Без шуток.
Автомобиль буквально проглатывает ямы, атакуя одну связку поворотов за другой.
Просторно, удобные кресла и неплохой акустический комфорт. ',
                'author' => 'портал <cite>autodraiv2020.ru</cite>'
            ],
            [
                'model_id' => 2,
                'type_id' => 8,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazve_wj/aa-trade21.htm',
                'quote' => 'В богатых комплектациях LADA Vesta SW Cross по оснащению существенно превосходит своих конкурентов.
Еще один плюс LADA Vesta – большое количество модификаций: в модельном ряду есть седаны и универсалы, как с обычным, так и с увеличенным дорожным просветом, а также уникальное предложение в сегменте – версия на газовом топливе.',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],
            [
                'model_id' => 2,
                'type_id' => 8,
                'url' => 'https://carexpert.ru/testdrive/vaz/vazve_wj/vazvea950.htm',
                'quote' => 'Дизайн без всяких сомнений заслуживает оценки “отлично”.
С такой внешностью автомобиль не затеряется и на парковке с автомобилями премиального класса.
Столь грамотно спроектированного багажного отсека, как у LADA Vesta SW Cross мы не встречали даже у иномарок. Здесь все продумано до мелочей. ',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],
            // Largus universal
            [
                'model_id' => 5,
                'type_id' => 3,
                'url' => 'https://www.kolesa.ru/test-drive/test-drayv-lada-largus-simptom-vyzdorovleniya-2012-10-16',
                'quote' => 'На фоне прочих моделей Lada выглядит Largus по-своему добротно и уютно. Lada Largus – автомобиль действительно доступный: универсал оказался дешевле Renault Logan, также производимого в России и уступающего в габаритах и вместительности. ',
                'author' => 'портал <cite>carexpert.ru</cite>'
            ],
        ];

        DB::table('reviews')->insert($reviews);
    }
}
