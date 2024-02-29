<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PillController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductFlavourController;
use App\Http\Controllers\ProductFlavourSizeController;
use App\Http\Controllers\SizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('Category', CategoryController::class);
Route::apiResource('cart', CartController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('flavors', FlavorController::class);
Route::apiResource('ProductFlavour', ProductFlavourController::class);
Route::apiResource('order', OrderController::class)->middleware('auth:sanctum');
Route::apiResource('pill', PillController::class)->middleware('auth:sanctum');
Route::apiResource('user', AuthController::class);
Route::post('register',[AuthController::class, 'register']);
