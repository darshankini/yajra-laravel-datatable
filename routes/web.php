<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/', [UsersController::class, 'index'])->name('home');
Route::resource('users', UsersController::class);
