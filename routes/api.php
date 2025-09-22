<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// Route::apiResource('product',ProductsController::class);
Route::middleware('auth:sanctum')->get('/user',function(Request $request){
    return Auth::user();
});
Route::apiResource('product', ProductController::class);
Route::post('auth/access-token',[AccessTokensController::class,'store']);
