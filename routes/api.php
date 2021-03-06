<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('products/popular', [ProductController::class, 'popular']);
Route::get('products/recommended', [ProductController::class, 'recommended']);
Route::apiResource('products', ProductController::class)->only('index', 'show');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class)->except('index', 'show');
});
