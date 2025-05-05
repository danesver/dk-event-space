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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'HomeController@main')->name('/');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/services', 'HomeController@services')->name('services');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/book-appointment', 'HomeController@bookAppointment')->name('book-appointment');
Route::get('/book-appointment-edit/{id}', 'HomeController@bookAppointmentEdit')->name('book-appointment-edit');

Route::post('/save-booking-form', 'HomeController@saveBookAppointment')->name('save-booking-form');

Route::post('/save-booking-confrimation', 'HomeController@saveBookConfrimation')->name('save-booking-confrimation');
Route::post('/save-booking-visit', 'HomeController@saveBookVisit')->name('save-booking-visit');

Route::post('/save-booking-cancel', 'HomeController@saveBookCancel')->name('save-booking-cancel');



Route::get('/my-events', 'HomeController@myEvents')->name('my-events');
Route::post('/send-mail', 'HomeController@sendMail')->name('send-mail');
Route::get('/cron-job', 'HomeController@cronJob')->name('cron-job');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
