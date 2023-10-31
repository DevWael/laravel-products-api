<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Authentication
Route::middleware('auth:sanctum')->post('/users', [UserController::class, 'store']);

// Register endpoint
Route::post('/register', [RegisterController::class, 'register']);

// Login endpoint
Route::post('/login', [AuthController::class, 'login']);

// Authentication required endpoints.
Route::middleware('auth:sanctum')->group(function () {
    // Products CRUD endpoints.
    Route::apiResource('products', ProductController::class);
});
