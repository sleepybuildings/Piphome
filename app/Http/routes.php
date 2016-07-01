<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('lights', 'LightsController@getLights');
Route::post('lights/toggle', 'LightsController@postToggle');
Route::post('lights/turn-all-off', 'LightsController@postTurnAllOff');

Route::get('ping', 'PingerController@getPing');

Route::get('weather', 'WeatherController@getTest');

Route::get('meter/current', 'MeterController@getCurrent');