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
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/event/{eventId}', 'EventController@index')->name('event');
Route::get('/merchandise', 'MerchandiseController@index')->name('merchandise');

// Fighter application form and submission
Route::get('/fighter-application', 'EventApplicationController@fighterForm')->name('application.fight');
Route::post('/fighter-application', 'EventApplicationController@storeFighterApp')->name('application.fight.submit');

// Sponsor application form and submission
Route::get('/sponsor-application', 'EventApplicationController@sponsorForm')->name('application.sponsor');
Route::post('/sponsor-application', 'EventApplicationController@storeSponsorApp')->name('application.sponsor.submit');

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