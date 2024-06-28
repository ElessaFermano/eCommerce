<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [UserController::class, 'welcome']);
Route::get('/login', [UserController::class, 'login']);
// Route::get('/register', [UserController::class, 'register']);
Route::get('/dashboard', [DashboardController::class, 'dashboard']);
Route::get('/product', [ProductController::class, 'index']);

Route::get('/register', function () {
    return view('register');
})->name('register');
