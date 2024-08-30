<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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

Route::resource('/', WelcomeController::class);
Route::resource('users', UserController::class);
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('checkout', OrderController::class);
Route::resource('shipping', ShippingController::class);
Route::resource('orders', OrderController::class);
Route::resource('reviews', ReviewController::class);

Route::get('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'register']);
Route::get('/dashboard', [DashboardController::class, 'dashboard']);
Route::get('/customer/{id}', [WelcomeController::class, 'customer']);
Route::get('/about', [WelcomeController::class, 'about']);
Route::get('totals', [DashboardController::class, 'total']);

Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/{id}', [CartController::class, 'viewCart']);
Route::get('/cart/count', [CartController::class, 'cartCount']);

Route::get('/shipping-fee', [ShippingController::class, 'getShippingFee'])->name('shipping.fee');
Route::post('/shipping-address', [ShippingAddressController::class, 'store'])->name('shipping-address.store');
Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

Route::get('/products/{product}/reviews', [ProductController::class, 'showReviews']);
Route::post('/products/{product}/reviews', [ProductController::class, 'addReview']);

Route::get('/inventory', [InventoryController::class, 'index']);
