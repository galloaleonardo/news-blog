<?php

Route::group(['middleware' => 'localization'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('news', 'NewsController');
        Route::get('search', 'NewsController@search')->name('news.search');
        Route::resource('categories', 'CategoryController');
        Route::resource('settings', 'SettingsController');
        Route::resource('users', 'UserController');
        Route::get('users/{user}/change-password', 'UserController@changePasswordShow')->name('users.change-password.show');
        Route::patch('users/{user}/change-password', 'UserController@changePassword')->name('users.change-password.update');
        Route::resource('advertisements', 'AdvertisingController', ['parameters' => ['advertisements' => 'advertising']]);
        Route::resource('google-ads', 'GoogleAdsController');
    });

    Route::get('/', 'MagazineController@index')->name('magazine.index');
    Route::get('/all', 'MagazineController@all')->name('magazine.all');
    Route::get('/show/{id}/{title}', 'MagazineController@show')->name('magazine.show');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
});
