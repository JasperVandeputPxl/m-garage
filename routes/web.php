<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TireController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('tires', TireController::class)
    ->except('show')
    ->middleware('auth');
Route::patch('/tires/quantity/{tire}', [TireController::class, 'quantity'])
    ->name('tires.quantity')
    ->middleware('auth');

Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::resource('users', UserController::class)
    ->except(['show', 'edit'])
    ->middleware('auth');
