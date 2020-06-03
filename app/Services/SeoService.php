<?php

namespace App\Services;

use App\CarModel;
use App\CarType;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use App\Seo;
use App\City;
use App\Contacts;

class SeoService
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Задаем мета теги
     *
     * @param $city
     * @param array $params
     * @return void
     */
    public function setMetaTags($city, array $params = []) : void
    {
        if ($city === null ) {
            return;
        }

        $path = $this->request->path();
        $seo = Seo::where('url', $path)->first();

        if ($seo === NULL) {
            $seo = $this->generateMetaTags($path, $city, $params);
        }

        $seo->og_title = empty($seo->og_title) ? $seo->title : $seo->og_title;
        $seo->og_description = empty($seo->og_description) ? $seo->description : $seo->og_description;

        SEOMeta::setTitle($seo->title);
        SEOMeta::setDescription($seo->description);
        SEOMeta::setCanonical($this->request->url());
        OpenGraph::setTitle($seo->og_title);
        OpenGraph::setDescription($seo->og_description);
        if (isset($seo->image) && $seo->image) {
            OpenGraph::addImage($seo->image);
        }
        if (isset($seo->place) && $seo->place) {
            OpenGraph::setType('place')
                ->setPlace([
                    'location:latitude' => $seo->place[0],
                    'location:longitude' => $seo->place[1],
                ]);
        }
        TwitterCard::setTitle($seo->title);

    }

    /**
     * Генерируем мета-теги
     *
     * @param string $path Путь на сайте
     * @param City $city Город
     * @param array $params Параметры
     * @return object
     */
    public function generateMetaTags(string $path, City $city, array $params = []) : object
    {
        $tags = new \stdClass;
        $segments = explode('/', $this->request->path());

        switch ( count($segments) )
        {
            case 1:
                $tags->title = "Брайт Парк - Официальный дилер LADA (ЛАДА) в " . $city->city_dative;
                $tags->description = "Выбираете где купить новую LADA (ЛАДА) по лучшей цене в " . $city->city_dative . "? У официального дилера LADA - Брайт Парк автомобили в наличии по лучшей стоимости. Также в нашем автосалоне выгодный обмен и кредит.";
                $tags->place = $params['place'];
                break;
            case 2:
                if ( $segments[1] === 'contacts' )
                {
                    $contacts = Contacts::where('city_id', $city->id)->first();
                    $tags->title = "Контакты Брайт Парка в " . $city->city_dative . ". Адрес: " . $contacts->address. ', Телефон: ' . $contacts->phone;
                    $tags->description = "Брайт Парк в " . $city->city_dative . ". " . $contacts->address . ', тел.: ' . $contacts->phone;
                } elseif ( $segments[1] === 'stocks' )
                {
                    $tags->title = "Акции на автомобили LADA в " . $city->city_dative;
                    $tags->description = "Ищете выгодные предложения на автомобили LADA в " . $city->city_dative . "? Посмотрите действующие акции в Брайт Парке";
                } elseif ( $segments[1] === 'news' )
                {
                       $tags->title = "Новости – Брайт Парк: официальный дилер LADA в " . $city->city_dative;
                       $tags->description = "Актуальные новости от официального дилера LADA в " . $city->city_dative . " – Брайт Парк. Узнайте первыми о новинках и специальных предложениях";
                } elseif ( $segments[1] === 'special_offers' ) {
                    $tags->title = "Брайт Парк - Официальный дилер LADA (ЛАДА) в " . $city->city_dative;
                    $tags->description = "Выбираете где купить новую LADA (ЛАДА) по лучшей цене в " . $city->city_dative . "? У официального дилера LADA - Брайт Парк автомобили в наличии по лучшей стоимости. Также в нашем автосалоне выгодный обмен и кредит.";
                    $tags->place = $params['place'];
                } elseif ( $segments[1] === 'privacy' )
                {
                    $tags->title = "Политика конфиденциальности Брайт Парк в " . $city->city_dative;
                    $tags->description = "Политика конфиденциальности Брайт Парк";
                } elseif ( $segments[1] === 'service' )
                {
                    $tags->title = "Сервисный центр автосалона Брайт Парк в " . $city->city_dative;
                    $tags->description = "Брайт Парк " . $city->title_ru . " предлагает Сервисное обслуживание автомобилей Лада в " . $city->city_dative;
                }

                break;
            case 3:
                if ( $segments[1] === 'stocks' )
                {
                    $tags->title = $params['stocks']->title . " - Брайт Парк" . $city->city_dative;
                    $tags->description = mb_strimwidth($params['stocks']->text_short, 0, 157, "...") . " - Брайт Парк в " . $city->city_dative;
                } elseif ( $segments[1] === 'news' )
                {
                    $tags->title = $params['news']->title . " - Брайт Парк в " . $city->city_dative;
                    $tags->description = mb_strimwidth($params['news']->text_short, 0, 157, "...") . " - Брайт Парк в " . $city->city_dative;
                } elseif ( $segments[1] === $params['model']->slug && $segments[2] === $params['type']->slug )
                {
                    if (strtolower($params['type']->title_ru) === 'xray') {
                        $model = $params['model']->title;
                    } else {
                        $model = $params['model']->title . " " . $params['type']->title_ru;
                    }
                    $tags->title = "Новая LADA " . $model . " по лучшей цене в " . $city->city_dative;
                    $tags->description = "Выбираете где купить новую LADA " . $model . " по лучшей цене в " . $city->city_dative . "? У официального дилера LADA - Брайт Парк " . $model . " в наличии по лучшей стоимости. Также у нас выгодный обмен и кредит.";
                    $tags->image = $params['image'];
                }
                break;
            case 4:
                if ( $segments[1] === $params['model']->slug && $segments[2] === $params['type']->slug && $segments[3] === 'model_details' )
                {
                    $tags->title = "Онлайн оценка автомобиля в Брайт Парк " . $city->title_ru;
                    $tags->description = "Не знаете, по какой цене продать свой автомобиль? В Брайт Парк онлайн оценка автомобиля в " . $city->city_dative;
                    $tags->image = $params['image'];
                }
                break;
            default:
                $tags->title = "Брайт Парк - Официальный дилер LADA (ЛАДА) в ";
                $tags->description = "Выбираете где купить новую LADA (ЛАДА) по лучшей цене? У официального дилера LADA - Брайт Парк автомобили в наличии по лучшей стоимости. Также в нашем автосалоне выгодный обмен и кредит.";
                break;
        }
        return $tags;
    }
}
