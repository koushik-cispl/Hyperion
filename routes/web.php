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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','LoginController@index');
Route::get('/admin/login','LoginController@index');
Route::post('/admin/login-submit','LoginController@loginSubmit');
Route::get('/admin/set-session/{userId}','LoginController@setSession');
Route::get('/admin/forget-password','LoginController@forgetPassword');
Route::post('/admin/check-value-exist','LoginController@checkValueExist');
Route::get('/admin/logout','LoginController@logout');

Route::get('/admin/dashboard','DashboardController@index');
Route::get('/admin/profile','DashboardController@profile');
Route::post('/admin/profile-update','DashboardController@profileUpdate');
Route::get('/admin/change-password','DashboardController@changePassword');
Route::post('/admin/change-password-update','DashboardController@changePasswordUpdate');

Route::get('/admin/users','UserController@index');
Route::get('/admin/new-user','UserController@newUser');
Route::post('/admin/new-user-create','UserController@newUserCreate');
Route::get('/admin/edit-user/{id}','UserController@editUser');
Route::post('/admin/edit-user-update','UserController@editUserUpdate');
Route::get('/admin/view-user/{id}','UserController@viewUser');
Route::post('/admin/delete-user','UserController@deleteUser');

Route::resource('/admin/prospects', 'ProspectsController');
Route::post('/admin/statechange','ProspectsController@stateChange');
Route::post('/admin/uploadcsv','ProspectsController@uploadcsv');
Route::get('/admin/search-prospect','ProspectsController@searchProspect');

Route::resource('/admin/crm', 'CrmController');
Route::get('/admin/select-campaign','PlaceOrderController@index');
//Ajax API below
Route::post('/admin/campaignchange', 'PlaceOrderController@campaignchange')->name('campaignchange');
Route::post('/admin/productchange', 'PlaceOrderController@productchange')->name('productchange');
Route::post('/admin/shippingChange', 'PlaceOrderController@shippingChange')->name('shippingChange');

Route::post('/admin/placeOrder','PlaceOrderController@placeOrder')->name('placeOrder');