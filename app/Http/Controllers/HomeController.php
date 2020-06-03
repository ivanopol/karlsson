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

        $cities = $city->getCities($this->city);
        $data['coordinates'] = explode(",", $city['coordinates']);
        $this->seo->setMetaTags($city, ['place' => $data['coordinates']]);

        $models = CarModel::with('types_preview')->get();
        $data['coordinates'] = explode(",", $city['coordinates']);

        return view('home', [
            'data' => $data,
            'city' => $this->city,
            'cities' => $cities,
            'models'=>$models,
        ]);
    }
}
