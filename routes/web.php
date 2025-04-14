<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;


Route::get('/', [UsersController::class, 'index']);
Route::get('users/export/', [UsersController::class, 'export'])->name('export');