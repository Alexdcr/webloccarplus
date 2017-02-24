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

Route::get('/', 'SiteController@welcome');//Route for Welcome View

//************************* ROUTES FOR VIEWS *******************************
Route::group(['prefix' => 'view'], function() {
    Route::get('login', 'SiteController@login');
    Route::get('register', 'SiteController@register');
    Route::get('forgot', 'SiteController@forgot');
    Route::get('map','SiteController@map');
		Route::get('account','SiteController@account');
		Route::get('cars','SiteController@vehicles');
		Route::get('test', 'SiteController@test');
});

//************************* ROUTES FOR WEB USER CONTROLLER *********************
Route::group(['prefix' => 'user'], function () {
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
    Route::post('forgot', 'UserController@forgot');
    Route::post('edit', 'UserController@edit');
    Route::get('recover', 'UserController@recover_password');
    Route::post('save', 'UserController@save');
    Route::post('delete', 'UserController@delete');
    Route::post('logout', 'UserController@logout');
		/*Route::post('add_cars', 'UserController@add_car');
		Route::post('delete_cars', 'UserController@delete_car');*/
});

//************************* ROUTES FOR WEB USER CARS CONTROLLER *********************
Route::group(['prefix' => 'cars'], function () {
		Route::post('add', 'CarsController@add');
		Route::post('edit', 'CarsController@edit');
		Route::post('save', 'CarsController@save');
		Route::post('delete', 'CarsController@delete');
});
