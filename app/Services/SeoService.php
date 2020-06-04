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
                $tags->title = "Карлссон " . $city->title_ru;
                $tags->description = "";
                $tags->place = $params['place'];
                break;
            case 2:
                if ( $segments[1] === 'privacy' )
                {
                    $tags->title = "Политика конфиденциальности Карлссон в " . $city->city_dative;
                    $tags->description = "Политика конфиденциальности Карлссон";
                }
                break;
            default:
                $tags->title = "Карлссон ";
                $tags->description = "";
                break;
        }
        return $tags;
    }
}
