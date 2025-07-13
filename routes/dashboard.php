<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashbordController;
// use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\Dashboard\ProductsController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth')->prefix('dashboard')->as('dashboard')->group(function(){

// });
Route::group(
    ['middleware'=>'auth',
    'as'=>'dashboard.',
    'prefix'=>'dashboard'
    ]
    ,function(){
Route::get('/', [DashbordController::class,'index'])->name('dashboard');
Route::get('/categories/trash',[CategoriesController::class,'trash'])->name('categories.trash');
Route::put('/categories/{category}/restore',[CategoriesController::class,'restore'])->name('categories.restore');
Route::delete('/categories/{category}/force-delete',[CategoriesController::class,'forceDelete'])->name('categories.forcedelete');
Route::resource('categories',CategoriesController::class);
Route::resource('products',ProductsController::class);
});
