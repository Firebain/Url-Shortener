<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/{shortUrl}', 'ShortUrlController@show')->name('redirect');

Route::group(["middleware" => "auth"], function () {
    Route::get('/', 'ShortUrlController@create')->name('home');

    Route::middleware("throttle:30,1")
        ->post('/create', "ShortUrlController@store")
        ->name('create');
});