<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['namespace'=>'api'],function() {
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
    Route::post('check_user','UserController@check_user');
    Route::post('book_ride/{vehicle}/{user}','BookingController@book_ride');



    //driver
    Route::post('driver_register', 'DriverController@driver_register');
    Route::post('driver_login', 'DriverController@driver_login');
//   Route::post('add_vehicle/{driver}','DriverController@add_vehicle');
//    Route::post('add_route','RouteController@add_route');
    Route::post('start_ride/{driver}','DriverController@start_ride');
    Route::get('bookings/{vehicle}','DriverController@bookings');

    //forget password
    Route::post('forgot_password', 'ForgotPasswordController@forgot_password');
    Route::post('confirm_code', 'ForgotPasswordController@confirm_code');
    Route::post('update_password', 'ForgotPasswordController@update_password');

    Route::post('available_rides','BookingController@available_rides');
    Route::get('available_seats/{vehicle}','BookingController@available_seats');

});
//Route::group([
//    'namespace' => 'Auth',
//    'middleware' => 'api',
//    'prefix' => 'password'
//], function () {
//    Route::post('create', 'PasswordResetController@create');
//    Route::get('find/{token}', 'PasswordResetController@find');
//    Route::post('reset', 'PasswordResetController@reset');
//});
