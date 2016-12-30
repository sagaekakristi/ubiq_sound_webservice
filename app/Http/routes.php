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

Route::get('/index', 'MultideviceController@index');

Route::get('/cron/on', 'MultideviceController@cron_on');
Route::get('/cron/reset', 'MultideviceController@cron_reset');

Route::get('/', 'MultideviceController@ui');
Route::post('/configureUI', 'MultideviceController@configureUI');
Route::get('/microphoneUI', 'MultideviceController@microphoneUI');

Route::get('/setScale', 'MultideviceController@set_scale');
