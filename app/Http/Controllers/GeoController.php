<?php
namespace App\Http\Controllers;

use App\Services\GeoLocationService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

/**
 * @property GeoLocationService geo_service
 */
class GeoController extends Controller
{
    public function __construct(GeoLocationService $geo_service)
    {
        $this->geo_service = $geo_service;
    }

    public function get_user_city_by_ip()
    {
        $city = $this->geo_service->get_user_city_by_ip($_SERVER['REMOTE_ADDR']);

        return Response::json($city);
    }
}
