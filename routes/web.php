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
Route::get('admin-home',function(){
    return view('admin.home');
});
Route::get('driver-index',function(){
    return view('admin.driver.index');
});
Route::get('driver-profile',function(){
    return view('admin.driver.profile');
});
Route::get('driver-pending',function(){
    return view('admin.driver.pending');
});
Route::get('driver-create',function(){
    return view('admin.driver.create');
});
Route::get('admin-user',function(){
    return view('admin.user.index');
});
Route::get('category-index',function(){
    return view('admin.category.index');
});
Route::get('category-create',function(){
    return view('admin.category.create');
});
Route::get('ride-index',function(){
    return view('admin.ride.index');
});
Route::get('ride-active',function(){
    return view('admin.ride.active');
});
Route::get('ride-completed',function(){
    return view('admin.ride.completed');
});
Route::get('ride-cancel',function(){
    return view('admin.ride.cancel');
});
Route::get('university-index',function(){
    return view('admin.university.index');
});
Route::get('user-profile',function(){
    return view('admin.user_profile');
});
// Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
//     Route::get('change_approve_status/{user}', 'UserController@change_approve_status')->name('admin.change_approve_status');
// });

