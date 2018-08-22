<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Definition of the Admin routes in the application.
| Routes in this file have the prefix /a/
|
*/

Route::get('/dashboard', function(){
    return view('admin.dashboard');
});