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

Auth::routes();


Route::get('login/{social}', 'Auth\LoginController@redirectToSocial')
    ->where('social','twitter|facebook|google|github');
Route::get('login/{social}/callback', 'Auth\LoginController@handleSocialCallback')
    ->where('social','twitter|facebook|google|github');

Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController');
    Route::get('/posts/trashed', [
        'uses' => 'PostController@trashed',
        'as' => 'posts.trashed',// route name

    ]);
});


