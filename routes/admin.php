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
})->name('admin.dashboard');

//View, Activate, Delete, Restore Users.
Route::get('/user-management', 'admin\UserManagementController@index')->name('admin.userManagement');
Route::put('/user-management/{userID}', 'admin\UserManagementController@toggleActive')->name('admin.userManagement.toggleActive');
Route::delete('/user-management/{userID}', 'admin\UserManagementController@destroy')->name('admin.userManagement.destroy');
Route::patch('/user-management/{userID}', 'admin\UserManagementController@restore')->name('admin.userManagement.restore');

//View, Create, Delete, Restore Groups.
Route::get('/group-management', 'admin\GroupManagementController@index')->name('admin.groupManagement');
Route::post('/group-management', 'admin\GroupManagementController@store')->name('admin.groupManagement.create');
Route::delete('/group-management/{groupID}', 'admin\GroupManagementController@destroy')->name('admin.group.destroy');
Route::patch('/group-management/{groupID}', 'admin\GroupManagementController@restore')->name('admin.groupManagement.restore');

//View, Update Group
Route::get('/group-management/{groupID}', 'admin\GroupManagementController@view')->name('admin.group');
Route::put('/group-management/{groupID}', 'admin\GroupManagementController@update')->name('admin.group.update');

//Add, Remove from Group
Route::post('/group-management/{groupID}', 'admin\GroupManagementController@addMember')->name('admin.group.addMember');
Route::delete('/group-management/{groupID}/{contact}', 'admin\GroupManagementController@removeMember')->name('admin.group.removeMember');

//Copy member to another Group
Route::put('/group-management/{groupID}/{memberID}/{memberType}', 'admin\GroupManagementController@addMemberToAnotherGroup')->name('admin.group.addToAnotherGroup');

//View, Create Delete, Restore Events
Route::get('/event-management', 'admin\EventManagementController@index')->name('admin.eventManagement');
Route::post('/event-management', 'admin\EventManagementController@store')->name('admin.eventManagement.store');
Route::delete('/event-management/{eventID}', 'admin\EventManagementController@destroy')->name('admin.eventManagment.destroy');
Route::patch('/event-management/{eventID}', 'admin\EventManagementController@restore')->name('admin.eventManagement.restore');

//Toggle event visibility
Route::put('/event-management/{eventID}', 'admin\EventManagementController@togglePublic')->name('admin.eventManagement.togglePublic');