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
Route::get('tests', function (){
    //dd('jj');
    return App\User::find(1)->profile->avatar;

});

Route::get('login/{social}', 'Auth\LoginController@redirectToSocial')
    ->where('social','twitter|facebook|google|github');
Route::get('login/{social}/callback', 'Auth\LoginController@handleSocialCallback')
    ->where('social','twitter|facebook|google|github');

Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function (){
    Route::get('/posts/trashed', [
        'uses' => 'PostController@trashed',
        'as' => 'posts.trashed',// route name

    ]);
    Route::get('/posts/restore/{id}', [
        'uses' => 'PostController@restore',
        'as' => 'posts.restore',// route name

    ]);
    Route::post('/posts/remove/{id}', [
        'uses' => 'PostController@remove',
        'as' => 'posts.remove',// route name

    ]);

    Route::get('/users', [
        'uses' => 'UserController@index',
        'as' => 'users'
    ]);

    Route::get('/user/create', [
        'uses' => 'UserController@create',
        'as' => 'user.create'
    ]);

    Route::post('/user/store', [
        'uses' => 'UserController@store',
        'as' => 'user.store'
    ]);

    Route::get('user/admin/{id}', [
        'uses' => 'UserController@admin',
        'as' => 'user.admin'
    ]);

    Route::get('user/not-admin/{id}', [
        'uses' => 'UserController@not_admin',
        'as' => 'user.not.admin'
    ]);

    Route::get('user/profile', [
        'uses' => 'ProfileController@index',
        'as' => 'user.profile'
    ]);
    Route::post('user/profile/update',[
        'uses' => 'ProfileController@update',
        'as' => 'user.profile.update'

    ]);

    Route::get('user/delete/{id}', [
        'uses' => 'UserController@destroy',
        'as' => 'user.delete'
    ]);
    Route::get('settings', [
        'uses' => 'SettingsController@index',
        'as' => 'settings'
    ]);
    Route::post('settings/update',[
        'uses' => 'SettingsController@update',
        'as' => 'settings.update'
    ]);

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagsController');

});


