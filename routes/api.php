<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\LocationController;

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

Route::middleware('auth:api')->group(function () {
    Route::get('/currentuser', [UserController::class, 'currentUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::controller(ArticleController::class)->group(function () {
    Route::get('/articles', 'index');
    Route::get('/articles/random', 'random');
    Route::post('/articles', 'store')->middleware('auth:api');
    Route::get('/articles/{article}', 'show')->middleware('auth:api');
    Route::post('/articles/{article}', 'update')->middleware('auth:api');
    Route::delete('/articles/{article}', 'destroy')->middleware('auth:api');
});

Route::controller(LocationController::class)->group(function () {
    Route::get('/locations', 'index');
    Route::post('/locations', 'store')->middleware('auth:api');
    Route::get('/locations/{location}', 'show')->middleware('auth:api');
    Route::post('/locations/{location}', 'update')->middleware('auth:api');
    Route::delete('/locations/{location}', 'destroy')->middleware('auth:api');
});

Route::controller(ImageController::class)->group(function () {
    Route::post('/images', 'store')->middleware('auth:api');
    Route::get('/images/{image}', 'show')->middleware('auth:api');
    Route::delete('/images/{image}', 'destroy')->middleware('auth:api');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index');
    Route::post('/categories', 'store')->middleware('auth:api');
    Route::get('/categories/{category}', 'show')->middleware('auth:api');
    Route::post('/categories/{category}', 'update')->middleware('auth:api');
    Route::delete('/categories/{category}', 'destroy')->middleware('auth:api');
});
