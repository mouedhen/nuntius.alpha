<?php

use \Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');



Route::any('{all}', function () {
    return view('app');
})->where(['all' => '^(?!api).*']);
