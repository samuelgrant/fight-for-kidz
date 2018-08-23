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

Route::get('/', function () {
    return view('index');
});

Route::get('/auction', function () {
    return view('auction');
});

Route::get('/previous', function () {
    return view('previous');
});

Route::get('/contenders', function () {
    return view('contenders');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/apply', function () {
    return view('apply');
});

Auth::routes();