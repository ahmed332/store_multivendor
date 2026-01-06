<?php

use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\Api\ProductController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

// Route::apiResource('product',ProductsController::class);
Route::middleware('auth:sanctum')->get('/user',function(Request $request){
    return Auth::user();
});
Route::apiResource('product', ProductController::class);
Route::post('auth/access-token',[AccessTokensController::class,'store'])
->middleware('guest:sanctum');
Route::delete('auth/access-token/{token?}',[AccessTokensController::class,'destroy'])
->Middleware('auth:sanctum');//مينفعش يحذف وهو مش auth
