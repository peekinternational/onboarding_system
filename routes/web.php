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
Route::match(['get','post'],'/admin/login', 'Dashboard\UserManageController@admin_login');
Route::group(['prefix' => 'dashboard'], function () {
	Route::get('/', 'Dashboard\UserManageController@dashboard');
    Route::get('/user_management', 'Dashboard\UserManageController@index');
	Route::post('/create_user', 'Dashboard\UserManageController@createUser');
	Route::get('/user/delete/{id}', 'Dashboard\UserManageController@destroy');
	Route::match(['get','post'],'/edit-user/{id}', 'Dashboard\UserManageController@editUser');
	Route::match(['get','post'],'/logout', 'Dashboard\UserManageController@logout');
	Route::resource('/numbers', 'Dashboard\NumberController');
	Route::post('/numbers/save', 'Dashboard\NumberController@store');
	Route::get('/numbers/delete/{id}', 'Dashboard\NumberController@destroy');
	Route::match(['get','post'],'/edit-number/{id}', 'Dashboard\NumberController@edit');
	Route::get('/payments', 'Dashboard\PaymentController@index');



	Route::get('/icons', function(){
		return view('/admin.icons');
	});
	Route::get('/add_tamplate', function(){
		return view('/admin.add_tamplate');
	});
	Route::get('/quotes','Dashboard\JobManageController@quotes');
	Route::get('/map', function(){
		return view('/admin.map');
	});
	Route::get('/notifications', function(){
		return view('/admin.notifications');
	});
	Route::get('/user', 'Dashboard\ProfileController@show_partner');
	Route::get('/tables', function(){
		return view('/admin.tables');
	});
	Route::get('/typography', function(){
		return view('/admin.typography');
	});
	Route::get('/upgrade', function(){
		return view('/admin.upgrade');
	});
	Route::get('/add-users', function(){
		return view('/admin.add-users');
	});
	Route::get('/edit-user/{id}', 'Dashboard\UserManageController@editUser' );
	// {
	// 	return view('/admin.edit_user');
	// });
});

//////////////////////// Admin Dashboard Close ////////////////////////////

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function() {
Route::group(['prefix' => 'user-portal'], function () {
	Route::get('/', function(){
		return view('frontend.dashboard.dashboard');
	});
	Route::get('/dashboard', 'frontend\DashboardController@index');


	Route::get('/change-password', function(){
		return view('frontend.dashboard.changepassword');
	});
	Route::get('/create-extension', function(){
		return view('frontend.dashboard.create-extension');
	});
	Route::get('/call-report', function(){
		return view('frontend.dashboard.call-report');
	});
	Route::get('/disposition-call-report', function(){
		return view('frontend.dashboard.disposition-call_report');
	});
	Route::get('/billing-info','PlanController@usershow');
	Route::match(['get','post'],'/manage-profile', 'frontend\RegisterController@show');
	Route::match(['get','post'],'/changeNumber', 'frontend\DashboardController@updateNumber');
	Route::get('/stopnumber/{id}', 'frontend\DashboardController@stopNumber');
	Route::get('/update-pricing-plan', 'PlanController@updateplan');
});

    Route::get('/pricing-plan', 'PlanController@index')->name('plans.index');
    Route::get('/plan/{plan}', 'PlanController@show')->name('plans.show');
    Route::post('/subscription', 'SubscriptionController@create')->name('subscription.create');



});
Route::match(['get','post'],'/register', 'frontend\RegisterController@register');
Route::match(['get','post'],'/verification', 'frontend\RegisterController@accountVerify');
Route::get('/resend-code', 'frontend\RegisterController@Resend_code');
Route::get('/login', 'frontend\RegisterController@accountLogin')->name('login');;
Route::post('/login', 'frontend\RegisterController@checklogin');
Route::get('logout', 'frontend\RegisterController@logout')->name('logout');
Route::get('/forget-password', 'frontend\RegisterController@forgetPassword');
Route::match(['get','post'],'/checkEmail','frontend\RegisterController@checkEmail');
Route::get('/check-token/{token}','frontend\RegisterController@checkToken');
Route::match(['get','post'],'/reset-passwrod','frontend\RegisterController@ResetPassword');
