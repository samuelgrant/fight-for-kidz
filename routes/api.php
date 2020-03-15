<?php

use App\Event;
use App\SiteSetting;
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
Route::middleware("api")->get('/sitemap', function (Request $request) {
    $index = SiteSetting::first();
    $events = Event::where('is_public', true)->orderBy('datetime', 'desc')->get();

    return response()->view('_sitemap', [
        'index' => $index,
        'events' => $events
    ])->header('Content-Type', 'text/xml');
});

Route::get('/captcha', function (Request $request) {
    return response()
        ->json([
            'debug' => 'true',
            'sitekey' => env('INVISIBLE_RECAPTCHA_SITEKEY')
        ]);
});