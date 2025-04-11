<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

// Mặc đinh api sẽ trỏ đến 5 phương thức trong controller
//Nếu muốn tạo hêm thương thức mới trong controller thì ta có thể sử dụng Route::apiResource và viết bên trên apiResource
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');
?>

