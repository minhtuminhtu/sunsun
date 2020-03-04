<?php

use App\Models\Yoyaku;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Mail;
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

// Route::get('/aaa', function () {
//     $payment  = new Payment();
//     $payment->booking_id = "1";
//     $payment->access_id = "1";
//     $payment->access_pass = "1";
//     $payment->save();
// });
Route::get('/phantom', function () {

});


// Route::get('/demo_lock', function () {


//     DB::unprepared("LOCK TABLE tr_yoyaku WRITE, tr_yoyaku_danjiki_jikan WRITE");
//     try{
//         DB::beginTransaction();
//         try {
//             $Yoyaku1 = new Yoyaku();
//             $Yoyaku1->booking_id = 2;
//             $Yoyaku1->course = 7;
//             $Yoyaku1->save();

//             new_test();


//             get_exeption();

//             DB::commit();
//         } catch (Exception $e) {
//             DB::rollBack();

//             // throw new Exception($e->getMessage());
//         }
//     }catch(Exception $e){
//         dd($e);
//     }
//     DB::unprepared("UNLOCK TABLE");
// });
// function get_exeption(){
//     throw new \ErrorException('Error found');
// }

// function new_test(){
//     $Yoyaku1 = new Yoyaku();
//     $Yoyaku1->booking_id = 2;
//     $Yoyaku1->course = 7;
//     $Yoyaku1->save();
// }

// Route::get('/clear', function () {
//     $booking_id = date("Ymd")."0001";
//     DB::select("
//         UPDATE `tr_yoyaku`
//         SET
//             `booking_id`= '$booking_id'
//             ,`ref_booking_id`= null
//             ,`history_id`=null
//             ,`name`=null
//             ,`phone`=null
//             ,`email`=null
//             ,`repeat_user`=null
//             ,`transport`=null
//             ,`bus_arrive_time_slide`=null
//             ,`bus_arrive_time_value`=null
//             ,`pick_up`=null
//             ,`course`='00'
//             ,`gender`=null
//             ,`age_type`=null
//             ,`age_value`=null
//             ,`service_date_start`=null
//             ,`service_date_end`=null
//             ,`service_time_1`=null
//             ,`service_time_2`=null
//             ,`time_json`=null
//             ,`bed`=null
//             ,`service_guest_num`=null
//             ,`service_pet_num`=null
//             ,`lunch`=null
//             ,`lunch_guest_num`=null
//             ,`whitening`=null
//             ,`whitening_repeat`=null
//             ,`whitening_time`=null
//             ,`pet_keeping`=null
//             ,`stay_room_type`=null
//             ,`stay_guest_num`=null
//             ,`stay_checkin_date`=null
//             ,`stay_checkout_date`=null
//             ,`breakfast`=null
//             ,`payment_method`=null
//             ,`notes`=null
//             ,`created_at`=null
//             ,`updated_at`=null
//         WHERE 1
//     ");
//     DB::select("
//         UPDATE
//             `tr_yoyaku_danjiki_jikan`
//         SET
//             `booking_id`='$booking_id'
//             ,`service_date`=0
//             ,`service_time_1`=null
//             ,`service_time_2`=null
//             ,`notes`=null
//             ,`time_json`=null
//             ,`created_at`=null
//             ,`updated_at`=null
//         WHERE 1
//     ");
//     echo "Clear done!";
// });

Route::get('/migrate', function () {
    exec("alias php=\'/usr/local/php7.3/bin/php\'");
    \Artisan::call('migrate');
    echo "Migrate done!";
});

// Route::get('/reset', function () {
//     exec("alias php=\'/usr/local/php7.3/bin/php\'");
//     \Artisan::call('migrate:reset');
//     \Artisan::call('migrate');
//     \Artisan::call('db:seed');
//     echo "Reset done!";
// });

Route::get('/cache', function () {
    exec("alias php=\'/usr/local/php7.3/bin/php\'");
    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('config:clear');
    \Artisan::call('view:clear ');
    echo "Cache cleared!";
});


Route::middleware('begin.auth')->group(function(){
    Route::namespace('Sunsun\Front')->group(function (){
        Route::get('/main', function (){
            return view('sunsun.front.main');
        })->name('main');
        Route::get('/thanks', function (){

        })->name('thanks');

        Route::get('/', function () {
            return view('sunsun.front.index');
        })->name('home');
        Route::get('/clear_session',['as' => '.clear_session', 'uses' => 'BookingController@clear_session']);

        Route::get('/booking',['as' => '.booking', 'uses' => 'BookingController@booking']);
        Route::post('/booking',['as' => '.back_2_booking', 'uses' => 'BookingController@back_2_booking']);
        Route::any('/confirm',['as' => '.confirm', 'uses' => 'BookingController@confirm']);
        Route::any('/payment',['as' => '.payment', 'uses' => 'BookingController@payment']);
        Route::post('/complete',['as' => '.complete', 'uses' => 'BookingController@complete']);
        Route::post('/make_payment',['as' => '.make_payment', 'uses' => 'BookingController@make_payment']);



        Route::post('/get_service',['as' => '.get_service', 'uses' => 'BookingController@get_service']);

        Route::post('/get_free_room',['as' => '.get_free_room', 'uses' => 'BookingController@get_free_room']);


        Route::post('/get_time_room',['as' => '.get_time_room', 'uses' => 'BookingController@get_time_room']);
        Route::post('/book_room',['as' => '.book_room', 'uses' => 'BookingController@get_time_room']);
        Route::post('/book_time_room_wt',['as' => '.book_time_room_wt', 'uses' => 'BookingController@book_time_room_wt']);
        Route::post('/book_time_room_pet',['as' => '.book_time_room_pet', 'uses' => 'BookingController@book_time_room_pet']);
        Route::post('/add_new_booking',['as' => '.add_new_booking', 'uses' => 'BookingController@add_new_booking']);
        Route::post('/validate_before_booking',['as' => '.validate_before_booking', 'uses' => 'BookingController@validate_before_booking']);
        Route::post('/save_booking',['as' => '.add_new_booking', 'uses' => 'BookingController@save_booking']);

    });

    // Auth
    Route::namespace('Sunsun\Auth')->group(function (){
        Route::get('/register', ['as' => 'register',  'uses' => 'MsUserController@register']);
        Route::get('/login', ['as' => 'login',  'uses' => 'LoginController@showLoginForm']);
        Route::get('/admin/login', ['as' => 'admin-login',  'uses' => 'LoginController@showLoginForm']);
        Route::post('/login', ['as' => 'auth', 'uses' => 'LoginController@login']);
        Route::post('/login-admin', ['as' => 'auth-admin', 'uses' => 'AdminLoginController@login']);
        Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
        Route::post('/create', ['as' => '.create',  'uses' => 'MsUserController@create']);
        Route::get('/forgot_password', ['as' => '.forgot_password',  'uses' => 'ResetPasswordController@index']);
        Route::post('/forgot_password', ['as' => '.reset_password',  'uses' => 'ResetPasswordController@exec']);
        Route::get('/reset_password/{token}', ['as' => '.change_password',  'uses' => 'ResetPasswordController@change']);
        Route::put('/reset_password', ['as' => '.reset_password',  'uses' => 'ResetPasswordController@update']);
    });
    // user
    Route::middleware('user.auth')->namespace('Sunsun\Auth')->group(function (){
        Route::get('/profile', ['as' => '.edit',  'uses' => 'AuthUserController@edit']);
        Route::post('/profile', ['as' => '.upload',  'uses' => 'AuthUserController@edit']);
        Route::get('/change_password', ['as' => '.change_password',  'uses' => 'AuthUserController@changepassword']);
        Route::put('/change_password', ['as' => '.changepassword',  'uses' => 'AuthUserController@changepassword']);
    });
    // Admin
    Route::group(['middleware' => 'CheckRole'], function () {
        Route::middleware('admin.auth')->prefix('admin')->name('admin')->namespace('Sunsun\Admin')->group(function (){
            Route::get('/',['as' => '.index', 'uses' => 'AdminController@index']);
            Route::any('/day',['as' => '.day', 'uses' => 'AdminController@day']);
            Route::get('/weekly',['as' => '.weekly', 'uses' => 'AdminController@weekly']);
            Route::get('/monthly',['as' => '.monthly', 'uses' => 'AdminController@monthly']);
            Route::get('/setting',['as' => '.setting', 'uses' => 'SettingController@setting']);
            Route::post('/get_setting_type',['as' => '.get_setting_type', 'uses' => 'SettingController@get_setting_type']);
            Route::post('/get_setting_kubun_type',['as' => '.get_setting_kubun_type', 'uses' => 'SettingController@get_setting_kubun_type']);
            Route::post('/update_setting_kubun_type',['as' => '.update_setting_kubun_type', 'uses' => 'SettingController@update_setting_kubun_type']);
            Route::post('/update_setting_sort_no',['as' => '.update_setting_sort_no', 'uses' => 'SettingController@update_setting_sort_no']);
            Route::delete('/delete_setting_kubun_type',['as' => '.delete_setting_kubun_type', 'uses' => 'SettingController@delete_setting_kubun_type']);

            Route::post('/edit_booking',['as' => '.edit_booking', 'uses' => 'AdminController@edit_booking']);
            // Route::post('/booking_history',['as' => '.booking_history', 'uses' => 'AdminController@booking_history']);
            Route::post('/show_history',['as' => '.show_history', 'uses' => 'AdminController@show_history']);
            Route::post('/update_booking',['as' => '.update_booking', 'uses' => 'AdminController@update_booking']);
            Route::post('/delete_booking',['as' => '.delete_booking', 'uses' => 'AdminController@delete_booking']);
            // user admin
            Route::get('/msuser',['as' => '.user', 'uses' => 'AdminController@user']);
            Route::post('/update_user',['as' => '.update_user', 'uses' => 'AdminController@update_user']);
            // Route::get('/search_user',['as' => '.search_user', 'uses' => 'AdminController@get_search_user']);
            Route::get('/search-paginate',['as' => '.search-paginate', 'uses' => 'AdminController@get_data_search_pagination']);
            Route::get('/export',['as' => '.export', 'uses' => 'AdminController@export']);

            // holiday
            Route::get('/ms_holiday',['as' => '.msholiday', 'uses' => 'AdminController@ms_holiday']);
            Route::post('/create',['as' => '.addmsholiday', 'uses' => 'AdminController@add_holiday']);
            Route::post('/update_holiday',['as' => '.update_holiday', 'uses' => 'AdminController@update_holiday']);
            Route::get('/holiday_search_paginate',['as' => '.search-paginate', 'uses' => 'AdminController@get_data_holiday_search_pagination']);

            // time off holiday
            Route::get('/time_off',['as' => '.timeoff', 'uses' => 'TimeOffController@Create']);
            Route::post('/ajax_time_off',['as' => '.ajax_time_off', 'uses' => 'TimeOffController@GetAjax']);
            Route::post('/submit_time_off',['as' => '.submit_time_off', 'uses' => 'TimeOffController@Submit']);
            // day off holiday
            Route::get('/day_off',['as' => '.dayoff', 'uses' => 'DayOffController@Create']);
            //Route::post('/create',['as' => '.create_dayoff', 'uses' => 'DayOffController@Submit']);
            Route::post('/submit_day_off',['as' => '.submit_day_off', 'uses' => 'DayOffController@Submit']);
            Route::post('/ajax_day_off',['as' => '.ajax_day_off', 'uses' => 'DayOffController@GetAjax']);
        });
    });
});
