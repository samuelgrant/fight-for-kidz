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
Route::get('/event/{eventId}', 'EventController@index')->name('event');
Route::get('/merchandise', 'MerchandiseController@index')->name('merchandise');

// Fighter application form and submission
Route::get('/fighter-application-old', 'EventApplicationController@fighterFormOld')->name('application.fight.old');
Route::get('/fighter-application', 'EventApplicationController@fighterForm')->name('application.fight');
Route::get('/api/fighter-application', 'EventApplicationController@fighterFormAPI')->middleware('api');
Route::post('/fighter-application', 'EventApplicationController@storeFighterApp')->name('application.fight.submit');

// Subscriber route
Route::post('/subscribe', 'SubscriberController@store')->name('subscribe');
Route::get('/unsubscribe', 'SubscriberController@showUnsubscribeForm')->name('mail.showUnsubscribeForm');
Route::post('/unsubscribe', 'SubscriberController@unsubscribe')->name('mail.unsubscribe');

//Get Auction info
Route::get('auction/{auctionId}', 'EventController@getAuctionItem')->name('getAuctionItem');

// Contender api
Route::get('/contenders/bio/{contenderID}', 'EventController@getContender')->name('getContender');

//Fight video api
Route::get('/bout/watch-fight/{boutID}', 'EventController@fightVideoModal')->name('fightVideoModal');
Route::get('/bout/{boutID}', 'EventController@getBout')->name('getBout');


// Contact us
Route::get('/contact-us', 'ContactController@index')->name('contact.index');
Route::post('/contact-us', 'ContactController@send');

// Auth routes
Auth::routes();
Route::post('/accept-cookies', 'CookieController@action');