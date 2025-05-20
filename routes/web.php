<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/users',action: [UserController::class,'index']) ->name('users.index');
Route::get('/users/create',action: [UserController::class,'create']) ->name('users.create');
Route::post('/users',action: [UserController::class,'store']) ->name('users.store');
Route::get('/users/{user}',action: [UserController::class,'show']) ->name('users.show');
Route::get('/users{user}/edit',action: [UserController::class,'edit']) ->name('users.edit');
Route::put('/users{user}',action: [UserController::class,'update']) ->name('users.update');
Route::delete('/users{user}',action: [UserController::class,'destroy']) ->name('users.destroy');
