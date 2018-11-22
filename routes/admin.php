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
    return view('admin.dashboard')->with('event', App\Event::current());
})->middleware('auth.activeUser')->name('admin.dashboard');

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

//View, create delete, assign sponsors
Route::get('/sponsor-management', 'admin\SponsorManagementController@index')->name('admin.sponsorManagement');
Route::get('/sponsor-management/{sponsorID}', 'admin\SponsorManagementController@view')->name('admin.sponsorManagement.view');
Route::post('/sponsor-management', 'admin\SponsorManagementController@store')->name('admin.sponsorManagement.store');
Route::patch('/sponsor-management/{sponsorID}', 'admin\SponsorManagementController@update')->name('admin.sponsorManagement.update');
Route::post('/sponsor-management/{sponsorID}', 'admin\SponsorManagementController@addToEvent')->name('admin.sponsorManagement.addToEvent');
Route::delete('/sponsor-management/{SponsorID}', 'admin\SponsorManagementController@deleteSponsor')->name('admin.sponsorManagement.deleteSponsor');
Route::delete('/sponsor-management/{SponsorID}/{eventID}', 'admin\SponsorManagementController@removeFromEvent')->name('admin.sponsorManagement.removeFromEvent');

// View system groups
Route::get('/group-management/all', 'admin\GroupManagementController@getAll')->name('admin.group.all');
Route::get('/group-management/subscribers', 'admin\GroupManagementController@getSubscribers')->name('admin.group.subscribers');
Route::get('/group-management/admins', 'admin\GroupManagementController@getAdmins')->name('admin.group.admins');
Route::get('/group-management/applicants', 'admin\GroupManagementController@getApplicants')->name('admin.group.applicants');
Route::get('/group-management/sponsors', 'admin\GroupManagementController@getSponsors')->name('admin.group.sponsors');
Route::get('/group-management/others', 'admin\GroupManagementController@getOthers')->name('admin.group.others');

//View, Update Group
Route::get('/group-management/{groupID}', 'admin\GroupManagementController@view')->name('admin.group');
Route::put('/group-management/{groupID}', 'admin\GroupManagementController@update')->name('admin.group.update');

//Add, Remove from Group
Route::post('/group-management/{groupID}', 'admin\GroupManagementController@addMember')->name('admin.group.addMember');
Route::delete('/group-management/{groupID}/{contact}', 'admin\GroupManagementController@removeMember')->name('admin.group.removeMember');

// Edit and delete other contacts
Route::patch('/group-management/contacts/{contactID}', 'admin\GroupManagementController@updateContact')->name('admin.contact.update');
Route::delete('/group-management/contacts/delete/{contactID}', 'admin\GroupManagementController@deleteContact')->name('admin.contact.delete');

// Get contact JSON
Route::get('/group-management/contacts/{contactID}', 'admin\GroupManagementController@getContact')->name('admin.contact.get');

//Copy member to another Group
Route::put('/group-management/{groupID}/{memberID}/{memberType}', 'admin\GroupManagementController@addMemberToAnotherGroup')->name('admin.group.addToAnotherGroup');

//View, Create Delete, Restore Events
Route::get('/event-management', 'admin\EventManagementController@index')->name('admin.eventManagement');
Route::get('/event-management/{eventID}', 'admin\EventManagementController@view')->name('admin.eventManagement.view');
Route::post('/event-management', 'admin\EventManagementController@store')->name('admin.eventManagement.store');
Route::put('/event-management/{eventID}/update', 'admin\EventManagementController@update')->name('admin.eventManagement.update');
Route::delete('/event-management/{eventID}', 'admin\EventManagementController@destroy')->name('admin.eventManagement.destroy');
Route::patch('/event-management/{eventID}', 'admin\EventManagementController@restore')->name('admin.eventManagement.restore');

//Toggle event settings
// Event visibility
Route::put('/event-management/togglepublic/{eventID}', 'admin\EventManagementController@togglePublic')->name('admin.eventManagement.togglePublic');
// Event applications
Route::put('/event-management/toggleapps/{eventID}', 'admin\EventManagementController@toggleApplications')->name('admin.eventManagement.toggleApplications');
// Event bout visibility
Route::put('/event-management/toggleBouts/{eventID}', 'admin\EventManagementController@toggleBouts')->name('admin.eventManagement.toggleBouts');

// Add/remove applicants to/from team
Route::put('/event-management/team/add', 'admin\ApplicantManagementController@addToTeam')->name('admin.eventManagement.addToTeam');
Route::delete('/event-management/team/remove', 'admin\ApplicantManagementController@removeFromTeam')->name('admin.eventManagement.removeFromTeam');

// Download applicants for a specific event
Route::get('/event-managment/{eventID}/applicants', 'admin\ApplicantManagementController@downloadExcel')->name('admin.eventManagment.downloadApplicants');

// Contender update
Route::patch('/event-management/contenders/{contenderID}', 'admin\ContenderManagementController@update')->name('admin.eventManagement.updateContender');

// Bouts CRUD functions
Route::patch('/event-management/bouts/{boutId}', 'admin\BoutManagementController@updateBoutDetails')->name('admin.eventManagement.updateBoutDetails');
Route::delete('/event-management/bouts/{boutId}', 'admin\BoutManagementController@removeBout')->name('admin.eventManagement.removeBout');
Route::put('/event-management/bouts/{eventId}', 'admin\BoutManagementController@addBout')->name('admin.eventManagement.addBout');

// Site settings functions
Route::patch('/dashboard/settings', 'admin\SiteSettingsController@update')->name('admin.updateSettings');

// File Uploads 
Route::post('/dashboard/uploads', 'admin\SiteSettingsController@storeFile')->name('admin.uploadFile');
Route::patch('/dashboard/uploads/{docID}', 'admin\SiteSettingsController@updateFile')->name('admin.updateFile');
Route::delete('/dashboard/uploads/{docID}', 'admin\SiteSettingsController@deleteFile')->name('admin.deleteFile');
Route::get('/dashboard/uploads/{docID}', 'admin\SiteSettingsController@getFile')->name('admin.getFile');

//Get Applicant Data
Route::get('/event-management/applicants/{applicantId}', 'admin\ApplicantManagementController@getApplicant')->name('admin.applicantManagement.getApplicant');

//Get contender data
Route::get('/event-management/contenders/{contenderID}', 'admin\ContenderManagementController@getContender')->name('admin.contenderManagement.getContender');

//Retrieve private images (https://laravel.io/forum/04-23-2015-securing-filesimages)
Route::get('/applicantImages/{imageName}', 'admin\ImageController@getApplicantImage')->where('imageName', '^[^/]+$')->name('admin.getApplicantImage');