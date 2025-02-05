<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/user', [UserController::class, 'show']);
Route::put('/user/update', [AuthController::class, 'update']);


Route::get('/menus', [MenuController::class, 'index']);
Route::get('/menus/{kategori}', [MenuController::class, 'menuSnack']);
Route::post('/menus', [MenuController::class, 'store']);
Route::get('/menus/{id}', [MenuController::class, 'show']);
Route::put('/menus/{id}', [MenuController::class, 'update']);
Route::delete('/menus/{id}', [MenuController::class, 'destroy']);

Route::get('/menu/kategori/{kategori}', [MenuController::class, 'getBykategori']);
Route::get('/menu/recomend/{recomend}', [MenuController::class, 'getByRecomend']);

Route::post('/transaction', [MidtransController::class, 'createTransaction']);
Route::post('/transaction/history', [OrderController::class, 'transaction']);
Route::post('transaction/status', [OrderController::class, 'status']);