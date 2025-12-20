<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\ReservationController;



Route::get('setting',                       [SettingController::class,      'index'])->name('api.setting.index');

Route::post('get_reservation',               [ReservationController::class,       'get_reservation'])->name('api.client.get_reservation');

Route::post('login_client',                         [ClientController::class,       'login_client'])->name('api.client.login_client');
Route::post('verifyOtp',                     [ClientController::class,       'verifyOtp'])->name('api.client.verifyOtp');

Route::post('register',                      [ClientController::class,       'register'])->name('api.client.register');


