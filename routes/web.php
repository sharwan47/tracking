<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});
Route::any('/test', 'App\Http\Controllers\TestController@index');
Route::get('/forgot-password','App\Http\Controllers\UserController@forgot_password');
Route::post('/forgot-password-send-mail','App\Http\Controllers\UserController@forgotpasswordmailsend');

Auth::routes();
Route::post('/signin', 'App\Http\Controllers\UserController@login');

Route::post('/do-login', 'App\Http\Controllers\UserController@dologin');

Route::group(['middleware' => 'auth'], function()
{
Route::get('/dashboard/{month}/{year}', 'App\Http\Controllers\DashboardController@index');
Route::get('/showEvent', 'App\Http\Controllers\DashboardController@showEvent');
Route::get('/showFullcalender', 'App\Http\Controllers\DashboardController@showFullcalender');
Route::get('/calender/{month}/{year}', 'App\Http\Controllers\DashboardController@calender');

///////////admin///////////////
Route::resource('/admins', 'App\Http\Controllers\AdminController');
Route::any('/storeadmin', 'App\Http\Controllers\AdminController@store');
Route::get('/addadmin', 'App\Http\Controllers\AdminController@add_admin');
Route::get('/addadmin', 'App\Http\Controllers\AdminController@add_admin');
Route::any('/admin/{id}/edit', 'App\Http\Controllers\AdminController@editAdmin');
Route::any('/storeadmin/update/{id}', 'App\Http\Controllers\AdminController@update');

///////bypass login for usr
Route::any('/bypasslogin', 'App\Http\Controllers\AdminController@byassLogin');
Route::any('/backtoadmin', 'App\Http\Controllers\AdminController@backLogin');


Route::resource('/users', 'App\Http\Controllers\UserController');
Route::get('/admin/users', 'App\Http\Controllers\UserController@index');
Route::get('/adduser', 'App\Http\Controllers\UserController@add_user');
Route::any('/storeuser', 'App\Http\Controllers\UserController@store');
Route::any('/storeuser/update/{id}', 'App\Http\Controllers\UserController@update');
Route::any('/storeuser/{id}/edit', 'App\Http\Controllers\UserController@edit');
Route::any('/distroy/{id}', 'App\Http\Controllers\UserController@distroy');
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
Route::get('/upload-file', 'App\Http\Controllers\DashboardController@file_upld');
Route::get('/take-photo', 'App\Http\Controllers\DashboardController@take_photos');
Route::post('/imagesave', 'App\Http\Controllers\DashboardController@store');
Route::get('/image/index', 'App\Http\Controllers\DashboardController@file_index');
Route::get('/edit/{id}/image', 'App\Http\Controllers\DashboardController@edit_image');
Route::post('/update_image/update/{id}', 'App\Http\Controllers\DashboardController@update_image');
Route::get('/delete/{id}', 'App\Http\Controllers\DashboardController@deletes');
Route::get('/logout','App\Http\Controllers\UserController@logout');

Route::resource('/take-photo','App\Http\Controllers\CameraController');
Route::get('show-photo/{id}','App\Http\Controllers\CameraController@show_photo_user_wise');
Route::get('/user-profile','App\Http\Controllers\UserController@user_profile');
Route::get('/update-profile','App\Http\Controllers\UserController@update_profile');
Route::post('/updatprofil/update/{id}','App\Http\Controllers\UserController@update_Profil');

Route::post('/addevent', 'App\Http\Controllers\EventController@store');
Route::post('/updateFullcalender', 'App\Http\Controllers\EventController@updateFullcalender');
Route::get('/deleteEvent', 'App\Http\Controllers\EventController@deleteEvent');
Route::post('/check-date', 'App\Http\Controllers\EventController@start_date_check');


Route::resource('/reminder', 'App\Http\Controllers\ReminderController');
Route::post('/reminder/update/{id}', 'App\Http\Controllers\ReminderController@update');
Route::get('/deleteReminders/{id}', 'App\Http\Controllers\ReminderController@deleteReminders');
Route::post('/addReminder', 'App\Http\Controllers\ReminderController@addReminder');
Route::get('/eidtReminder', 'App\Http\Controllers\ReminderController@eidtReminder');
Route::post('/updateReminder', 'App\Http\Controllers\ReminderController@updateReminder');
Route::get('/deleteRemender/{id}', 'App\Http\Controllers\ReminderController@deleteRemender');
Route::get('/deleteRepeat/{id}', 'App\Http\Controllers\ReminderController@deleteRepeat');
Route::post('/AddMedicalcard/', 'App\Http\Controllers\ReminderController@AddMedicalcard');

Route::resource('/EstimatePayment', 'App\Http\Controllers\EstimatePaymentModeController');
Route::post('/Payment-Conformed-Update', 'App\Http\Controllers\EstimatePaymentModeController@PaymentConformedUpdate');


Route::resource('/ExciseTax', 'App\Http\Controllers\ExciseTaxController');
Route::post('/Ifta-Payment-Conformed-Update', 'App\Http\Controllers\ExciseTaxController@IftaPaymentConformedUpdate');
});

