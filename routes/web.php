<?php
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/home', function () {
        return view('welcome');
    });
});
