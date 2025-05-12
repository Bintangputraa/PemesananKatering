<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [OrderController::class, 'show']);
Route::post('/daftar', [UserController::class, 'add']);
Route::post('/registrasi', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/transaction', [OrderController::class, 'index']);
Route::post('transaction/status', [OrderController::class, 'status']);

Route::get('/user', [UserController::class, 'index']);

Route::get('/menu', [MenuController::class, 'index']);