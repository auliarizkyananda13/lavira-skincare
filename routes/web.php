<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CartController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Untuk detail produk

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create');
});

Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment')->middleware(['auth']);

Route::post('/order/store', [OrderController::class, 'store'])->middleware(['auth'])->name('order.store');
Route::post('/order/store-cart', [OrderController::class, 'storeFromCart'])->middleware(['auth'])->name('cart.order.store');
Route::get('/order/success', function () {
    return view('order-success');
})->middleware(['auth'])->name('order.success');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin-dashboard');
    Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products/store', [AdminController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{id}/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/cart/checkout', [PaymentController::class, 'checkoutCart'])->name('cart.checkout');
});

Route::get('/search', [ProductController::class, 'search'])->name('product.search');
