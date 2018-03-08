<?php

use Illuminate\Support\Facades\Route;

/*
 * Access url
 */
Route::group(['prefix' => env('API_VERSION'), 'namespace' => 'API'], function () {

    Route::group(['namespace' => 'Auth'], function () {

        Route::get('login', 'AccessController@loginIndex')->name('login');
        Route::get('logout', 'AccessController@logoutIndex')->name('logout');

        Route::post('login', 'AccessController@login')->name('auth.login');

        Route::group([
            // @IMPORTANT: TODO activate authentication
            // 'middleware' => 'auth:api',
        ], function () {
            Route::get('profile', 'AccessController@profile')->name('auth.profile');
            Route::post('logout', 'AccessController@logout')->name('auth.logout');

            /*
             * Resources APIs
             */
            Route::apiResources([
                'users' => 'UserController',
            ], [
                'except' => ['create', 'edit',]
            ]);

            /*
             * Read only APIs
             */
            Route::apiResources([
                'activities' => 'ActivityController',
                'roles' => 'RoleController',
                'permissions' => 'PermissionController',
            ], [
                'except' => ['create', 'store', 'edit', 'update', 'destroy']
            ]);

        });
    });

    Route::group([
        'namespace' => 'Locations'
    ], function () {

        Route::group([
            // 'middleware' => 'auth:api'
        ], function () {

            Route::apiResources([
                'cities' => 'CityController',
                'municipalities' => 'MunicipalityController',
            ], [
                'except' => ['create', 'edit',]
            ]);

            Route::apiResources([
                'countries' => 'CountriesController',
            ], [
                'except' => ['create', 'store', 'edit', 'update', 'destroy']
            ]);
        });

    });

});


