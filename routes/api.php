<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('reset-password', 'AuthController@resetPassword')->name("reset-password");
        Route::get('reset-password-test/{email}', 'AuthController@resetPasswordTest')->name("reset-password-test");
        Route::post('reset-password-confirm', 'AuthController@resetPasswordConfirm')->name("reset-password-confirm");
        Route::post('verify-email', 'AuthController@verifyEmail');
    });
    
    //for authenticated
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('logout', 'AuthController@logout');
            Route::post('verify-token', 'AuthController@verifyToken');
            Route::post('update-password', 'UserController@updatePassword');
        });

        Route::group(['prefix' => 'shops'], function () {
            Route::get('/', 'ShopController@index');
            Route::post('user/{id}', 'ShopController@userShops');
            Route::post('create', 'ShopController@store');
            Route::post('view/{id}', 'ShopController@show');
            Route::post('update/{id}', 'ShopController@update');
            Route::post('delete/{id}', 'ShopController@destroy');
        });

        Route::group(['prefix' => 'services'], function () {
            Route::get('/', 'ServicesController@index');
            Route::post('shop/{id}', 'ServicesController@shopServices');
            Route::post('create', 'ServicesController@store');
            Route::post('view/{id}', 'ServicesController@show');
            Route::post('update/{id}', 'ServicesController@update');
            Route::post('delete/{id}', 'ServicesController@destroy');
        });

        Route::group(['prefix' => 'profile'], function () {
            Route::post('create', 'ProfileController@store');
            Route::post('view', 'ProfileController@show');
            Route::post('update', 'ProfileController@update');
        });

        Route::group(['prefix' => 'search'], function () {
            Route::post('/', 'SearchController@search');
            Route::get('/all', 'SearchController@index');
            Route::get('/labandero', 'SearchController@getLabandero');
            // Route::post('view', 'ProfileController@show');
            // Route::post('update', 'ProfileController@update');
        });

        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', 'DashboardController@index');
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index');
            Route::post('activate/{id}', 'UserController@activateUser');
            Route::post('deactivate/{id}', 'UserController@deactivateUser');
        });
    });

});