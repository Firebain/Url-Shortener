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

Route::group(["middleware" => "auth"], function () {
    Route::get('/', 'ShortUrlController@create')->name('short_urls.create');

    Route::middleware("throttle:30,1")
        ->post('/short_urls', "ShortUrlController@store")
        ->name('short_urls.store');

    Route::get('/short_urls', 'ShortUrlController@index')->name('short_urls.index');
});

Route::get('/{shortUrl}', 'ShortUrlController@show')->name('short_urls.show');