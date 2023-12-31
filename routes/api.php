<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagePostController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RelatedPostController;
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

// Categories routes

Route::middleware('auth:sanctum')->group(function() {
    Route::post('categories/create', [CategoryController::class, 'store']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::put('categories/{category}', [CategoryController::class, 'update']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
});

Route::get('categories', [CategoryController::class, 'index']);

// Private posts routes

Route::middleware('auth:sanctum')->group(function() {
    Route::post('posts', [PostController::class, 'store']);
    Route::get('manage-posts', [ManagePostController::class, 'index']);
    Route::get('posts/show-post/{post:link}', [PostController::class, 'show']);
    Route::put('posts/{post:link}', [PostController::class, 'update']);
    Route::delete('posts/{post:link}', [PostController::class, 'destroy']);
});

// Public user routes

Route::post('register', [UserController::class, 'store']);
Route::post('login', [UserController::class, 'login']);

// Public posts routes

Route::get('home-posts', [HomeController::class, 'index']);
Route::get('posts/{post:link}', [PostController::class, 'getPost']);
Route::get('posts', [PostController::class, 'index']);
Route::get('related-posts/{post:link}', [RelatedPostController::class, 'index']);

// Public office routes
Route::get('/offices', [OfficeController::class, 'index']);
