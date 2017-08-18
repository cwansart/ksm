<?php

Route::get('check', '\App\Http\Controllers\Auth\LoginController@check');
Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');

Route::get('/', function () {
    return view('app');
})->name('home');
