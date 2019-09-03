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
Auth::routes(['verify' => true]);
Route::get('first-access/{user}', 'Auth\FirstAccessController@verify');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'first.access']], function () {
    Route::get('/', function () { return view('admin.dashboard'); })->name('dashboard');
    Route::resource('news', 'NewsController');
    Route::get('search', 'NewsController@search')->name('news.search');
    Route::resource('categories', 'CategoryController');
    Route::resource('users', 'UserController');
    Route::resource('advertisements', 'AdvertisingController', ['parameters' => ['advertisements' => 'advertising']]);
});
