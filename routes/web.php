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
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/event/{eventId}', 'EventController@index')->name('event');
Route::get('/merchandise', 'MerchandiseController@index')->name('merchandise');

// Fighter application form and submission
Route::get('/fighter-application', 'EventApplicationController@fighterForm')->name('application.fight');
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
Route::post('/contact/general', 'ContactController@general')->name('contact.general');
Route::post('/contact/sponsor', 'ContactController@sponsor')->name('contact.sponsor');
Route::post('/contact/table', 'ContactController@table')->name('contact.table');

// Auth routes
Auth::routes();