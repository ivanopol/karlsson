<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_city_by_ip', 'GeoController@get_user_city_by_ip');
Route::get('/get_brand_models', 'ModelController@get_brand_models');
Route::post('/get_estimation', 'ModelController@getEstimation');
Route::get('/get_complectations/{brand_id}/{model_id}', 'ModelController@getComplectations');
Route::get('/get_credit_programs', 'ModelController@getCreditPrograms');
Route::post('/write_event', 'EventController@write_event');
Route::post('/get_cars_list', 'ModelController@getCarsList');



