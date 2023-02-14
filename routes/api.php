<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentGateWays;
use App\Http\Controllers\FileControler;
use App\Jobs\MailSend;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


Route::controller(AuthController::class)->group(function () {
    Route::post('auth/login', 'login');
});
Route::get('sanctum/csrf-cookie', function () {
    return response('OK', 204);
});
Route::group(['middleware' => ['auth:sanctum', 'permission']], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('auth/user', 'user');
        Route::post('auth/logout', 'logout')->name('Auth: logout');
    });
});

// forgot password
Route::controller(AuthController::class)->group(function () {
    Route::post('/forgot-password', 'handleForgotPassword')->middleware('guest')->name('password.request');
    Route::post('/password/reset/{token}', 'resetPassword')->middleware('guest')->name('password.request');

});
// file
Route::controller(FileControler::class)->group(function () {
    Route::post('/add-file', 'addFile');
    Route::post('/', 'addFile');
});


//  payment gateway
Route::controller(PaymentGateWays::class)->group(function () {
    Route::post('/master-session', 'MasterPay');
    Route::post('/unipay', 'UnionPay');
    Route::post('/check_user_api', 'CreateUser');

});
