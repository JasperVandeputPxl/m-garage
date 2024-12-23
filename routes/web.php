<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TireController;

Route::get('/', [TireController::class, 'index'])->name('home');

Route::resource('tires', TireController::class)->except('show');
