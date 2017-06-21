<?php

// v1
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $namespace = 'App\Http\Controllers';

    $api->get('/getUserInfo', $namespace.'\Api\UserController@getInfo');
});

Auth::routes();
Route::group([], function () {
    Route::get('/', 'HomeController@index')->name('/');
});







