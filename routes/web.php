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
Route::group(['prefix' => 'user-portal'], function () {
	Route::get('/', function(){
		return view('frontend.dashboard.dashboard');
	});
	Route::get('/manage-profile', function(){
		return view('frontend.dashboard.profile');
	});
	Route::get('/change-password', function(){
		return view('frontend.dashboard.changepassword');
	});
});

    Route::get('/plans', 'PlanController@index')->name('plans.index');
    Route::get('/plan/{plan}', 'PlanController@show')->name('plans.show');
    Route::post('/subscription', 'SubscriptionController@create')->name('subscription.create');

Route::match(['get','post'],'/register', 'frontend\RegisterController@register');
Route::match(['get','post'],'/verification', 'frontend\RegisterController@accountVerify');
Route::match(['get','post'],'/login', 'frontend\RegisterController@accountLogin');
Route::get('logout', 'frontend\RegisterController@logout');

Route::get('/pricing-plan', function(){
	return view('frontend.membership');
});
Route::get('/update-pricing-plan', function(){
	return view('frontend.update-pricing');
});
