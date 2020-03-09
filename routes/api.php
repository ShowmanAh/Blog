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
Route::post('register','Api\AuthController@register');
Route::post('login','Api\AuthController@login');
Route::post('password/email','Api\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset','Api\ResetPasswordController@reset');
//Route::resource('categories','Api\CategoryController');
Route::get('categories','Api\CategoryController@index');
Route::get('categories/{id}','Api\CategoryController@show');
Route::post('categories','Api\CategoryController@store');
Route::post('categories/{id}','Api\CategoryController@update');
Route::get('categories/delete/{id}','Api\CategoryController@destroy');
