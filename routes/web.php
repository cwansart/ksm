<?php

$appView = function() {
    return view('app');
};
Route::get('/', $appView);

Route::get('check', 'Auth\LoginController@check');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');

Route::resource('cats', 'CatController');

