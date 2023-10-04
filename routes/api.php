<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Private user routes

Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [UserController::class, 'logout']);
});

// Private categories routes

Route::middleware('auth:sanctum')->group(function() {
    Route::post('categories/create', [CategoryController::class, 'store']);
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::put('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
});

// Public routes

Route::post('register', [UserController::class, 'store']);
Route::post('login', [UserController::class, 'login']);
