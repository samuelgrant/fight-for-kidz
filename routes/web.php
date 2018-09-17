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

Route::get('/', 'PagesController@index')->name('index');
Route::get('/auction', 'PagesController@auction')->name('auction');
Route::get('/previous', 'PagesController@previous')->name('previous');
Route::get('/contenders', 'PagesController@contenders')->name('contenders');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/Merchandise', 'MerchandiseController@Merchandise')->name('Merchandise');

Route::get('/apply', 'EventApplicationController@index')->name('application');
Route::post('/apply', 'EventApplicationController@store')->name('apply');

// Subscriber route
Route::post('/subscribe', 'SubscribersController@store')->name('subscribe');

Auth::routes();