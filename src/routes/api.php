<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController; // <-- This is the import for your controller
use App\Http\Controllers\ProductController;

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

// This is the default route that comes with Laravel
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// This is the new line you added for your task API
// It creates all 5 endpoints: GET, POST, GET(id), PUT(id), DELETE(id)
Route::apiResource('task', TaskController::class);
Route::apiResource('products', \App\Http\Controllers\ProductController::class);