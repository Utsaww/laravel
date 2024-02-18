<?php

use App\Http\Controllers\LanguageController;

/*
 * Global Routes
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LanguageController::class, 'swap']);

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    include_route_files(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /*
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     * These routes can not be hit if the password is expired
     */
    include_route_files(__DIR__.'/backend/');
});
/*
Route::get('/',function() {
    return view('users.index');
});*/
Route::get('/', 'HomeController@index');
Route::post('/studentlogin', 'HomeController@studentLogin')->name('studentlogin');
Route::post('/studentregister', 'HomeController@studentRegister')->name('studentregister');
Route::post('/studentlogout', 'HomeController@studentLogout')->name('studentlogout');


Route::get('/question_paper/{id}','HomeController@questionPaper')->where('id', '[0-9]+');
Route::get('/instruction/{id}','HomeController@instruction')->middleware('userrole')->where('id', '[0-9]+');
Route::get('/test/{id}','HomeController@test')->middleware('userrole')->where('id', '[0-9]+')->name('testpage');
Route::post('/updatetest','HomeController@updateTest')->middleware('userrole')->name('updatetest');
Route::post('/updateendtest','HomeController@updateEndTest')->middleware('userrole')->name('updateendtest');
Route::get('/endtest','HomeController@endTest')->middleware('userrole')->name('endtest');
Route::get('/aboutus',function() {
    return view('users.about');
});
Route::get('/message',function() {
    return view('users.message');
});
Route::get('/faqs',function() {
    return view('users.faqs');
});
Route::get('/testimonials',function() {
    return view('users.testimonials');
});
Route::get('/policy',function() {
    return view('users.policy');
});
Route::get('/disclaimer',function() {
    return view('users.disclaimer');
});
Route::get('aboutexam/{exam}','HomeController@aboutexam');
Route::get('/test-series',function() {
    return view('users.test-series');
});


Route::get('{coursename}','HomeController@index');
Route::get('{coursename}/list','HomeController@allCourseTest');
Route::get('{coursename}/{type}/list','HomeController@courseTypeAllTest');
Route::get('{coursename}/{type}/{categoryname}/list','HomeController@courseTypeCategotyAllTest');
Route::get('{coursename}/{type}/{categoryname}/{subjectname}/list','HomeController@courseTypeCategotySubjectAllTest');
Route::get('{coursename}/{type}/{categoryname}/{subjectname}/{topicname}/list','HomeController@courseTypeCategotySubjectTopicAllTest');

