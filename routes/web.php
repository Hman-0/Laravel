<?php

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CustomersControler;
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
        Route::get('/delete', [ProductController::class, 'delete'])->name('delete');
        Route::put('/{id}/restore', [ProductController::class, 'restore'])->name('restore');
        Route::post('/{id}/forceDelete', [ProductController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
        Route::get('/delete', [CategoryController::class, 'delete'])->name('delete');
        Route::put('/{id}/restore', [CategoryController::class, 'restore'])->name('restore');
        Route::post('/{id}/forceDelete', [CategoryController::class, 'forceDelete'])->name('forceDelete');
    });
    Route::prefix('banners')->name('banners.')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::get('/create', [BannerController::class, 'create'])->name('create');
        Route::post('/store', [BannerController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BannerController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [BannerController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [BannerController::class, 'destroy'])->name('destroy');
        Route::get('/delete', [BannerController::class, 'delete'])->name('delete');
        Route::put('/{id}/restore', [BannerController::class, 'restore'])->name('restore');
        Route::post('/{id}/forceDelete', [BannerController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostsController::class, 'index'])->name('index');
        Route::get('/create', [PostsController::class, 'create'])->name('create');
        Route::post('/store', [PostsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PostsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [PostsController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [PostsController::class, 'destroy'])->name('destroy');
        Route::get('/delete', [PostsController::class, 'delete'])->name('delete');
        Route::put('/{id}/restore', [PostsController::class, 'restore'])->name('restore');
        Route::post('/{id}/forceDelete', [PostsController::class, 'forceDelete'])->name('forceDelete');
    });
    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactsController::class, 'index'])->name('index');
        Route::get('/create', [ContactsController::class, 'create'])->name('create');
        Route::post('/store', [ContactsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ContactsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ContactsController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [ContactsController::class, 'destroy'])->name('destroy');
        Route::get('/delete', [ContactsController::class, 'delete'])->name('delete');
        Route::put('/{id}/restore', [ContactsController::class, 'restore'])->name('restore');
        Route::post('/{id}/forceDelete', [ContactsController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/', [ReviewsController::class, 'index'])->name('index');
        Route::get('/create', [ReviewsController::class, 'create'])->name('create');
        Route::post('/store', [ReviewsController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ReviewsController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ReviewsController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [ReviewsController::class, 'destroy'])->name('destroy');
        Route::get('/delete', [ReviewsController::class, 'delete'])->name('delete');
        Route::put('/{id}/restore', [ReviewsController::class, 'restore'])->name('restore');
        Route::post('/{id}/forceDelete', [ReviewsController::class, 'forceDelete'])->name('forceDelete');
    });
    Route::prefix('customers')->name('customers.')->group(function () {
        Route::get('/', [CustomersControler::class, 'index'])->name('index');
        Route::get('/create', [CustomersControler::class, 'create'])->name('create');
        Route::post('/store', [CustomersControler::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CustomersControler::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [CustomersControler::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [CustomersControler::class, 'destroy'])->name('destroy');
        Route::get('/delete', [CustomersControler::class, 'delete'])->name('delete');
        Route::put('/{id}/restore', [CustomersControler::class, 'restore'])->name('restore');
        Route::post('/{id}/forceDelete', [CustomersControler::class, 'forceDelete'])->name('forceDelete');
    });
    
});
