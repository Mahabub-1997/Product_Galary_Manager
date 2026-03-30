<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    Route::post('/products/{product}/images', [ProductImageController::class, 'store'])->name('products.images.store');
    Route::delete('/products/images/{image}', [ProductImageController::class, 'destroy'])->name('products.images.destroy');
    Route::post('/product/image/upload', [ProductImageController::class, 'uploadImage'])->name('products.image.upload');
    Route::delete('/product/image/{id}', [ProductImageController::class, 'deleteImage'])->name('products.image.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
