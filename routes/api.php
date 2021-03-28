<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/status', function () {
        return response()->json([
            'message' => 'Running',
            'payload' => null,
            'status'  => Constants::STATUS_CODE_SUCCESS
        ]);
    });

    //admin auth
    Route::group(['prefix' => 'admin', 'middleware' => ['throttle:30,1']], function () { //max 30 request in i min
        Route::post('/login', ['App\Http\Controllers\Admin\Api\AdminController', 'login']);
        Route::post('/forget-password', ['App\Http\Controllers\Admin\Api\AdminController', 'forgetPassword']);
        Route::post('/reset-password', ['App\Http\Controllers\Admin\Api\AdminController', 'resetPassword']);

        Route::group(['middleware' => ['jwt.verify']], function () {
            Route::post('/refresh-token', ['App\Http\Controllers\Admin\Api\AdminController', 'refreshToken'])->name('refresh-token');
            Route::get('/me', ['App\Http\Controllers\Admin\Api\AdminController', 'me']);

            Route::match(['get', 'post'], '/login-credentials', ['App\Http\Controllers\Admin\Api\AdminController', 'loginCredentials']);

            Route::match(['get', 'post'], '/settings', ['App\Http\Controllers\Admin\Api\SettingController', 'index']);

            Route::match(['post', 'delete'], '/logos', ['App\Http\Controllers\Admin\Api\SettingController', 'logo']);
        });
    });
});