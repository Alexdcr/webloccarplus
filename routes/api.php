<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//************************* ROUTE FOR TEST API CONTROLLER *********************
Route::get('/test_get', function () {
    return response()->json(array('status' => 'success', 'type' => 'get for api function'));
});

Route::post('/test_post', function () {
    return response()->json(array('status' => 'success', 'type' => 'post  for api function'));
});

//************************* ROUTES FOR API USER CONTROLLER *********************
Route::group(['prefix' => 'user'], function () {
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
    Route::post('forgot', 'UserController@forgot');
    Route::post('edit', 'UserController@edit');
    Route::get('recover', 'UserController@recover_password');
    Route::post('save', 'UserController@save');
    Route::post('delete', 'UserController@delete');
    Route::post('logout', 'UserController@logout');
});

//************************* ROUTES FOR API LOCATION CONTROLLER *********************
Route::group(['prefix' => 'user'], function () {
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
    Route::post('forgot', 'UserController@forgot');
    Route::post('edit', 'UserController@edit');
    Route::get('recover', 'UserController@recover_password');
    Route::post('save', 'UserController@save');
    Route::post('delete', 'UserController@delete');
    Route::post('logout', 'UserController@logout');
});
