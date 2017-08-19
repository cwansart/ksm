<?php

Route::get('/', function () {
    return view('app');
})->name('home');

Route::get('check', 'Auth\LoginController@check');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'LoginController@logout');

Route::resource('cat', 'CatController');

