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


Route::namespace('Sunsun\Front')->group(function (){
    Route::get('/', function () {
        return view('sunsun.front.index');
    })->name('home');

    Route::get('/booking',['as' => '.booking', 'uses' => 'BookingController@booking']);
    Route::any('/confirm',['as' => '.confirm', 'uses' => 'BookingController@confirm']);
    Route::post('/payment',['as' => '.payment', 'uses' => 'BookingController@payment']);



    Route::post('/get_service',['as' => '.get_service', 'uses' => 'BookingController@get_service']);

    Route::post('/get_time_room',['as' => '.get_time_room', 'uses' => 'BookingController@get_time_room']);
    Route::post('/book_room',['as' => '.book_room', 'uses' => 'BookingController@book_room']);
    Route::post('/book_time_room_pet',['as' => '.book_time_room_pet', 'uses' => 'BookingController@book_time_room_pet']);
    Route::post('/add_new_booking',['as' => '.add_new_booking', 'uses' => 'BookingController@add_new_booking']);
    Route::post('/save_booking',['as' => '.add_new_booking', 'uses' => 'BookingController@save_booking']);

});

// Auth
Route::namespace('Sunsun\Auth')->group(function (){
    Route::get('/register', ['as' => 'register',  'uses' => 'MsUserController@register']);
    Route::get('/login', ['as' => 'login',  'uses' => 'LoginController@showLoginForm']);
    Route::post('/login', ['as' => 'auth', 'uses' => 'LoginController@login']);
    Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
    Route::Post('/create', ['as' => '.create',  'uses' => 'MsUserController@create']);
});
// user
Route::middleware('auth')->namespace('Sunsun\Auth')->group(function (){
    Route::get('/edit', ['as' => '.edit',  'uses' => 'AuthUserController@edit']);
    Route::Post('/edit', ['as' => '.upload',  'uses' => 'AuthUserController@edit']);
    Route::get('/changepassword', ['as' => '.password',  'uses' => 'AuthUserController@changepassword']);
    Route::post('/changepassword', ['as' => '.changepassword',  'uses' => 'AuthUserController@changepassword']);
});
// Admin
Route::middleware('auth', 'can:admin')->prefix('admin')->name('admin')->namespace('Sunsun\Admin')->group(function (){
    Route::get('/day',['as' => '.day', 'uses' => 'AdminController@day']);
    Route::get('/weekly',['as' => '.weekly', 'uses' => 'AdminController@weekly']);
    Route::get('/monthly',['as' => '.monthly', 'uses' => 'AdminController@monthly']);
});

