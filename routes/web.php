<?php

use App\Http\Middleware\EnsureUserChangedFirstPassword;
use App\Http\Middleware\EnsureUserIsNotDisabled;

Route::group(['middleware' => 'localization'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

        Route::get('first-login', 'FirstLoginController@index')->name('first-login.index');
        Route::post('first-login', 'FirstLoginController@store')->name('first-login.store');

        Route::middleware([EnsureUserChangedFirstPassword::class, EnsureUserIsNotDisabled::class])->group(function () {
            Route::get('/', 'DashboardController@index')->name('dashboard');
            Route::resource('news', 'NewsController');
            Route::get('search', 'NewsController@search')->name('news.search');
            Route::resource('categories', 'CategoryController');
            Route::resource('settings', 'SettingsController');
            Route::resource('users', 'UserController');
            Route::get('users/{user}/change-password', 'UserController@changePasswordShow')->name('users.change-password.show');
            Route::patch('users/{user}/change-password', 'UserController@changePassword')->name('users.change-password.update');
            Route::resource('advertisements', 'AdvertisingController', ['parameters' => ['advertisements' => 'advertising']]);
            Route::resource('top-banner', 'TopBannerController');
            Route::resource('top-banner-setting', 'TopBannerSettingController');
            Route::resource('google-ads', 'GoogleAdsController');
            Route::resource('google-analytics', 'GoogleAnalyticsController');
            Route::resource('seo', 'SeoMagazineController');
            Route::resource('authors', 'AuthorController');
        });
    });

    Route::get('/', 'MagazineController@index')->name('magazine.index');
    Route::get('/all', 'MagazineController@all')->name('magazine.all');
    Route::get('/show/{id}/{title}', 'MagazineController@show')->name('magazine.show');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
});
