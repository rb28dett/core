<?php

Route::group([
        'middleware' => [
            'web', 'rb28dett.base', 'rb28dett.auth', 'throttle:60,1',
        ],
        'prefix'    => config('rb28dett.settings.api_url'),
        'namespace' => 'RB28DETT\RB28DETT\Controllers',
        'as'        => 'rb28dett_api::',
    ], function () {
        Route::post('/save_menu_action', 'RB28DETTController@saveMenuAction')->name('save_menu_action');
    });
