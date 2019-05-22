<?php

Route::group([
        'middleware' => ['web', 'rb28dett.base'],
        'prefix'     => config('rb28dett.settings.base_url'),
        'namespace'  => 'RB28DETT\RB28DETT\Controllers',
        'as'         => 'rb28dett::',
    ], function () {
        Route::get('/', 'RB28DETTController@index')->name('index');
        Route::get('/login', 'LoginController@show')->name('login');
        Route::post('/login', 'LoginController@login')->name('login_post');
    });
