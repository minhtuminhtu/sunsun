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
    });
    Route::get('/booking',['as' => '.booking', 'uses' => 'BookingController@booking']);
    Route::post('/confirm',['as' => '.confirm', 'uses' => 'BookingController@confirm']);
    Route::post('/payment',['as' => '.payment', 'uses' => 'BookingController@payment']);

    Route::post('/get_service',['as' => '.get_service', 'uses' => 'BookingController@get_service']);

    Route::post('/get_time_room',['as' => '.get_time_room', 'uses' => 'BookingController@get_time_room']);
    Route::post('/book_room',['as' => '.book_room', 'uses' => 'BookingController@book_room']);
    Route::post('/book_time_room_pet',['as' => '.book_time_room_pet', 'uses' => 'BookingController@book_time_room_pet']);


});

