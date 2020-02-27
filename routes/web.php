<?php

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('news', 'NewsController');
    Route::get('search', 'NewsController@search')->name('news.search');
    Route::resource('categories', 'CategoryController');
    Route::resource('users', 'UserController');
    Route::resource('advertisements', 'AdvertisingController', ['parameters' => ['advertisements' => 'advertising']]);
});

Route::get('/', 'MagazineController@index')->name('magazine.index');
Route::get('/show/{news}', 'MagazineController@show')->name('magazine.show');
