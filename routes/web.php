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
Route::match(['get','post'],'/admin/login', 'Dashboard\JobManageController@admin_login');
Route::group(['prefix' => 'dashboard'], function () {
	Route::get('/', function(){
		return view('/admin.index');
	});

	Route::match(['get','post'],'/logout', 'Dashboard\JobManageController@logout');
	Route::get('/job_management', 'Dashboard\JobManageController@index');
	Route::get('/blogs', 'Dashboard\JobManageController@blogs');
	Route::get('/blog/create', 'frontend\BlogController@create');
	Route::get('/blog/edit/{id}', 'frontend\BlogController@edit');
	Route::get('/blog/delete/{id}', 'frontend\BlogController@destroy');
	Route::post('/blog/store', 'frontend\BlogController@store');
	Route::match(['get','post'],'/template/{id}', 'Dashboard\JobManageController@template');
	Route::get('/upload_tamplate', 'Dashboard\JobManageController@showtemplate');
	Route::get('/job_delete/{id}', 'Dashboard\JobManageController@destroy');
	Route::post('/post_portal', 'Dashboard\JobManageController@post_portal');
	Route::post('/mark', 'Dashboard\JobManageController@mark');
	Route::match(['get','post'],'/jobstatus_update/{id}', 'Dashboard\JobManageController@jobstatus_update');

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
	Route::get('/edit_user/{id}', function(){
		return view('/admin.edit_user');
	});
});

//////////////////////// Admin Dashboard Close ////////////////////////////

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function() {
Route::group(['prefix' => 'user-portal'], function () {
	Route::get('/', function(){
		return view('frontend.dashboard.index');
	});
	Route::get('/dashboard', function(){
		return view('frontend.dashboard.dashboard');
	});
	
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
	Route::get('/billing-info', function(){
		return view('frontend.dashboard.billing-info');
	});
	Route::get('/manage-profile', function(){
		return view('frontend.dashboard.profile');
	});
});

    Route::get('/pricing-plan', 'PlanController@index')->name('plans.index');
    Route::get('/plan/{plan}', 'PlanController@show')->name('plans.show');
    Route::post('/subscription', 'SubscriptionController@create')->name('subscription.create');

Route::get('/update-pricing-plan', function(){
	return view('frontend.update-pricing');
});

});
Route::match(['get','post'],'/register', 'frontend\RegisterController@register');
Route::match(['get','post'],'/verification', 'frontend\RegisterController@accountVerify');
Route::get('/login', 'frontend\RegisterController@accountLogin')->name('login');;
Route::post('/login', 'frontend\RegisterController@checklogin');
Route::get('logout', 'frontend\RegisterController@logout')->name('logout');



