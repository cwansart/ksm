<?php

Route::get('/', function() {
    return view('app');
});

Route::get('check', 'Auth\LoginController@check');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');

Route::resource('cats', 'CatController');
Route::resource('mediations', 'MediationController');
