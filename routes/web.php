<?php

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/{id}/show', [ProductController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::put('/{id}/update', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store' , [CategoryController::class,'store'])->name('store');
        Route::get('/{id}/edit' , [CategoryController::class , 'edit'])->name('edit');
        Route::put('/{id}/update' , [CategoryController::class , 'update'])->name('update');
        Route::delete('/{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
    });
    Route::prefix('banners')->name('banners.')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::get('/create', [BannerController::class, 'create'])->name('create');
        Route::post('/store', [BannerController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BannerController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [BannerController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [BannerController::class, 'destroy'])->name('destroy');
    });

});

