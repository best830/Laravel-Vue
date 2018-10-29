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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('profile', 'HomeController@profile')->middleware('verified');

Route::namespace('Admin')->prefix('admin')->as('admin.')->middleware(['role:admin','verified'])->group(function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::resource('tutor', 'TutorController');
    Route::resource('student', 'StudentController');
    Route::resource('domain', 'DomainController');
    Route::resource('payment', 'PaymentController');
    Route::get('/password/edit', 'PasswordController@edit')->name('password.edit');
    Route::put('/password', 'PasswordController@update')->name('password.update');
    Route::resource('message', 'MessageController');

});

Route::namespace('Tutor')->prefix('tutor')->as('tutor.')->middleware(['role:tutor','verified'])->group(function () {
    Route::get('/', 'TutorController@index')->name('index');
    Route::resource('student', 'StudenttController');
    Route::get('/material/download', 'MaterialController@download')->name('material.download');
    Route::resource('material', 'MaterialController');
    Route::get('/meditation/calendar', 'MeditationController@calendar')->name('meditation.calendar');
    Route::get('/session/{id}/confirm', 'SessionController@confirm')->name('session.confirm');
    Route::get('/session/{id}/notconfirm', 'SessionController@notconfirm')->name('session.notconfirm');
    Route::resource('session', 'SessionController');
    Route::resource('meditation', 'MeditationController');
    Route::get('/password/edit', 'PasswordController@edit')->name('password.edit');
    Route::put('/password', 'PasswordController@update')->name('password.update');

    Route::get('/theme/download', 'ThemeController@download')->name('theme.download');
    Route::post('/theme/rate', 'ThemeController@rate')->name('theme.rate');
    Route::resource('theme', 'ThemeController');
    Route::resource('comment', 'CommentController');
    Route::get('/message/admin', 'MessageController@admin_show')->name('message.admin.show');
    Route::post('/message/admin', 'MessageController@admin_store')->name('message.admin.store');

    Route::resource('message', 'MessageController');

});

Route::namespace('Student')->prefix('student')->as('student.')->middleware(['role:student','verified'])->group(function () {
    Route::get('/', 'StudentController@index')->name('index');
    Route::resource('tutor', 'TutorController');
    Route::get('/material/download', 'MaterialController@download')->name('material.download');
    Route::resource('material', 'MaterialController');
    Route::get('/meditation/calendar', 'MeditationController@calendar')->name('meditation.calendar');
    Route::get('/session/{id}/confirm', 'SessionController@confirm')->name('session.confirm');
    Route::get('/session/{id}/notconfirm', 'SessionController@notconfirm')->name('session.notconfirm');
    Route::resource('meditation', 'MeditationController');
    Route::get('/password/edit', 'PasswordController@edit')->name('password.edit');
    Route::put('/password', 'PasswordController@update')->name('password.update');

    Route::get('/theme/download', 'ThemeController@download')->name('theme.download');
    Route::resource('theme', 'ThemeController');
    Route::resource('message', 'MessageController');

});

Route::get('events', 'EventController@index');