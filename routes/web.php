<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MyOrderController;
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

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Account Routes
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::post('/account/update', [AccountController::class, 'update'])->name('account.update');
    Route::post('/account/password', [AccountController::class, 'updatePassword'])->name('account.password');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/order-summary', [OrderController::class, 'index'])->name('order-summary');
    Route::post('/order/create-transaction', [OrderController::class, 'createTransaction'])->name('order.create-transaction');
    
    // Payment Routes
    Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
    
    // My Orders Routes
    Route::get('/my-orders', [MyOrderController::class, 'index'])->name('my-orders');
    Route::get('/my-orders/{transaction}', [MyOrderController::class, 'show'])->name('my-orders.show');
    Route::post('/my-orders/{transaction}/cancel', [MyOrderController::class, 'cancel'])->name('my-orders.cancel');
    Route::post('/my-orders/{transaction}/reorder', [MyOrderController::class, 'reorder'])->name('my-orders.reorder');
    Route::post('/my-orders/{transaction}/complete', [MyOrderController::class, 'complete'])->name('my-orders.complete');
});

// Midtrans callback route (no auth required)
Route::post('/payment/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('transactions', TransactionController::class);
});
