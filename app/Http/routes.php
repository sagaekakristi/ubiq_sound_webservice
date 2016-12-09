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

Route::get('/index', 'SoundSystemController@index');

Route::get('/cron/on', 'SoundSystemController@cron_on');
Route::get('/cron/reset', 'SoundSystemController@cron_reset');