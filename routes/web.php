<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [ProductController::class, 'all'])->name('home');

    Route::get('/products', [ProductController::class, 'all'])->name('product');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');

    Route::post('/orders/{product}', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'list'])->name('orders.list');

    Route::get('/payments/{order}', [PaymentController::class, 'index'])->name('payment.index');

    Route::post('/logout', function () {
        auth()->logout();
        return redirect()->route('home');
    })->name('logout');
});

require __DIR__.'/auth.php';
