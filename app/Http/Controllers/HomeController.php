<?php

namespace App\Http\Controllers;


use App\CarModelCarType;
use App\Services\AutoruService;
use App\Services\BasePageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CarModel;
use App\CarType;
use App\City;
use App\Retarget;
use App\News;
use App\Stocks;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use App\Services\SeoService;

class HomeController extends Controller
{
    public $city;
    public $seo;

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->seo = new SeoService($request);
    }

    /**
     * Главная страница
     *
     * @param City|null $city
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(City $city = null)
    {
        if ($city['alias']) {
            $this->city = $city['alias'];
        } else {
            return redirect()->route('index', ['city' => 'perm']);
        }

        $data = [];
        $cities = $city->getCities($this->city);
        $data['coordinates'] = explode(",", $city['coordinates']);
        $models = CarModel::with('types_preview')->get();

        $this->seo->setMetaTags($city, ['place' => $data['coordinates']]);

        return view('home', ['data' =>  $data, 'models' => $models, 'city' => $this->city, 'cities' => $cities]);
    }

    /**
     * Ретаргетинговая страница
     *
     * @param City|null $city
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function special_offers(City $city = null, Request $request)
    {

        if ($city['alias']) {
            $this->city = $city['alias'];
        } else {
            return redirect()->route('index', ['city' => 'perm']);
        }

        $cities = $city->getCities($this->city);
        $data['coordinates'] = explode(",", $city['coordinates']);
        $this->seo->setMetaTags($city, ['place' => $data['coordinates']]);

        $service = new BasePageService();
        $offer = $service->getRetargetOffers(new Retarget(), $request);
        $models = CarModel::with('types_preview')->get();

        $raw = new AutoruService();
        $brands = $raw->getBrands();

        $car_model = CarModel::find(1);
        $car_type = CarType::find(1);

        $car_attrs = CarModelCarType::where([
            ['car_model_id', '=', $car_model->id],
            ['car_type_id', '=', $car_type->id],
        ])->limit(1)->get();


        return view('offers', [
            'offer' => $offer,
            'city' => $this->city,
            'cities' => $cities,
            'models'=>$models,
            'brands' => $brands,
            'car_model' => $car_model,
            'car_type' => $car_type,
            'car_attrs' => $car_attrs,
        ]);
    }

    /**
     * Страница модели
     *
     * @param City|null $city
     * @param CarModel $car_model
     * @param CarType $car_type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function model(City $city = null, CarModel $car_model, CarType $car_type)
    {
        if ($city['alias']) {
            $this->city = $city['alias'];
        } else {
            return redirect()->route('model', ['city' => 'perm', 'car_model' => $car_model->slug, 'car_type' => $car_type->slug]);
        }

        $cities = $city->getCities($this->city);
        $service = new BasePageService();
        $models = CarModel::with('types_preview')->get();
        $data = $service->get_base_page_data($car_model, $car_type, $this->city);
        $data['coordinates'] = explode(",", $city['coordinates']);

        $this->seo->setMetaTags($city, [
            'model' => $car_model,
            'type' => $car_type,
            'image' => str_replace('mobile/', '', $data['blocks'][0]->url),
            'place' => $data['coordinates']
        ]);

        return view('model', [ 'data' => $data, 'models' => $models, 'city' => $this->city, 'cities' => $cities]);
    }

    /**
     * Сбытовая страница
     *
     * @param City|null $city
     * @param CarModel $car_model
     * @param CarType $car_type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function model_details(City $city = null, CarModel $car_model, CarType $car_type)
    {
        $data = [];
        $service = new BasePageService();
        $data['car_preview'] = $service->getCarPreviewPath($car_model->id, $car_type->id);
        $this->seo->setMetaTags($city, ['model' => $car_model, 'type' => $car_type, 'image' => $data['car_preview']->image ]);

        if ($city['alias']) {
            $this->city = $city['alias'];
        } else {
            return redirect()->route('model_details', ['city' => 'perm', 'car_model' => $car_model->slug, 'car_type' => $car_type->slug]);
        }

        $cities = $city->getCities($this->city);
        $models = CarModel::with('types_preview')->get();

        $car_attrs = CarModelCarType::where([
            ['car_model_id', '=', $car_model->id],
            ['car_type_id', '=', $car_type->id],
        ])->limit(1)->get();

        $raw = new AutoruService();
        $brands = $raw->getBrands();

        if (!isset($_COOKIE["c_count"])) {
            $count = rand(7, 15);
            setcookie("c_count", $count);
        } else {
            $count = $_COOKIE["c_count"];
        }

        if (strtolower($car_type->title_ru) === 'xray') {
            $car_type->title_ru = '';
        }

        return view('model_details', [
            'data' => $data,
            'brands' => $brands,
            'models' => $models,
            'city' => $this->city,
            'cities' => $cities,
            'car_model' => $car_model,
            'car_type' => $car_type,
            'car_attrs' => $car_attrs,
            'count' => $count,
        ]);
    }

    /**
     * Страница вывода списка новостей
     *
     * @param City|null $city
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function news(City $city = null)
    {
        $this->seo->setMetaTags($city);

        if ($city['alias']) {
            $this->city = $city['alias'];
        } else {
            return redirect()->route('news', ['city' => $this->city]);
        }

        $cities = $city->getCities($this->city);
        $models = CarModel::with('types_preview')->get();

        $data['coordinates'] = explode(",", $city['coordinates']);

        $news = News::whereIn('city_id', [0, $city['id']])->orderBy('id', 'desc')->get();

        return view('news', [
            'data'=>$data,
            'city'=>$this->city,
            'city_info' => $city,
            'cities' => $cities,
            'models' => $models,
            'news' => $news,
        ]);
    }

    /**
     * Страница новости
     *
     * @param City|null $city
     * @param News $news_title
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function news_details(City $city = null, News $news_title)
    {
        $this->seo->setMetaTags($city, [ 'news' => $news_title ]);

        if ($city['alias']) {
            $this->city = $city['alias'];
        } else {
            return redirect()->route('news_details', ['city' => 'perm']);
        }

        $cities = $city->getCities($this->city);
        $models = CarModel::with('types_preview')->get();
        $data['coordinates'] = explode(",", $city['coordinates']);

        return view('news_one', [
            'data' => $data,
            'news'=> $news_title,
            'city'=>$this->city,
            'cities' => $cities,
            'models' => $models,
        ]);
    }

    /**
     * Страница вывода списка акций
     *
     * @param City|null $city
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function stocks(City $city = null)
    {
        $this->seo->setMetaTags($city);

        if ($city['alias']) {
            $this->city = $city['alias'];
        } else {
            return redirect()->route('stocks', ['city' => $this->city]);
        }

        $cities = $city->getCities($this->city);
        $models = CarModel::with('types_preview')->get();

        $data['coordinates'] = explode(",", $city['coordinates']);

        $stocks = Stocks::whereIn('city_id', [0, $city['id']])->orderBy('id', 'desc')->get();

        return view('stocks', [
            'data'=>$data,
            'city'=>$this->city,
            'city_info' => $city,
            'cities' => $cities,
            'models' => $models,
            'stocks' => $stocks,
        ]);
    }

    /**
     * Страница акции
     *
     * @param City|null $city
     * @param Stocks $stocks_title
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function stocks_details(City $city = null, Stocks $stocks_title)
    {
        $this->seo->setMetaTags($city, [ 'stocks' => $stocks_title ]);

        if ($city['alias']) {
            $this->city = $city['alias'];
        } else {
            return redirect()->route('stocks_details', ['city' => 'perm']);
        }

        $cities = $city->getCities($this->city);
        $models = CarModel::with('types_preview')->get();
        $data['coordinates'] = explode(",", $city['coordinates']);

        return view('stocks_one', [
            'data' => $data,
            'stocks'=> $stocks_title,
            'city'=>$this->city,
            'cities' => $cities,
            'models' => $models,
        ]);
    }

    /**
     * Страница контактов
     *
     * @param City $city
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contacts(City $city)
    {
        $this->seo->setMetaTags($city);

        if ($city['alias']) {
            $this->city = $city['alias'];
        } else {
            return redirect()->route('stocks_details', ['city' => 'perm']);
        }

        $cities = $city->getCities($this->city);
        $models = CarModel::with('types_preview')->get();
        $data['coordinates'] = explode(",", $city['coordinates']);

      //  print_r($data['coordinates']);
        return view('contacts', [
            'data' => $data,
            'city'=>$this->city,
            'cities' => $cities,
            'models' => $models,
        ]);
    }

    /**
     * Страница политики конфиденциальности
     *
     * @param City $city
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function privacy(City $city)
    {
        $this->seo->setMetaTags($city);

        if ($city['alias']) {
            $this->city = $city['alias'];
        } else {
            return redirect()->route('stocks_details', ['city' => 'perm']);
        }

        $cities = $city->getCities($this->city);
        $models = CarModel::with('types_preview')->get();
        $data['coordinates'] = explode(",", $city['coordinates']);

        //  print_r($data['coordinates']);
        return view('privacy', [
            'data' => $data,
            'city'=>$this->city,
            'cities' => $cities,
            'models' => $models,
        ]);
    }

    /**
     * Страница Сервиса
     *
     * @param City|null $city
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function service(City $city = null)
    {
        if ($city['alias']) {
            $this->city = $city['alias'];
        } else {
            return redirect()->route('index', ['city' => 'perm']);
        }

        $cities = $city->getCities($this->city);
        $data['coordinates'] = explode(",", $city['coordinates']);
        $this->seo->setMetaTags($city, ['place' => $data['coordinates']]);

        $models = CarModel::with('types_preview')->get();
        $data['coordinates'] = explode(",", $city['coordinates']);

        return view('service', [
            'data' => $data,
            'city' => $this->city,
            'cities' => $cities,
            'models'=>$models,
        ]);
    }

}
