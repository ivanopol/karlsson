<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('send', 'FeedbackController@send');
Route::middleware(['utm.check', 'cookie.check', 'counter'])->group(function () {
    Route::get('/{city?}', 'HomeController@index')->name('index');
});
