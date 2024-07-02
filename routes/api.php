<?php

use App\Http\Controllers\Api\ProductApiController;
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

Route::post('/login', [UserController::class, 'loginUser' ]);
Route::post('/register', [UserController::class, 'registerUser'])->name('registerUser');

// Route::get('/products', [ProductApiController::class, 'index']);
// Route::get('/products/{id}', [ProductApiController::class, 'show']);
// Route::post('/products', [ProductApiController::class, 'store']);
// Route::put('/products/{id}', [ProductApiController::class, 'update']);
// Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);

