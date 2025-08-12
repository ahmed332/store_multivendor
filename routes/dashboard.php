<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashbordController;
// use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth')->prefix('dashboard')->as('dashboard')->group(function(){

// });
 Route::get('dashboard',[DashbordController::class,'index'])->name('dashboard')->middleware(['auth','CheckUserType:admin,super_admin']);
Route::group(
    ['middleware'=>['auth','CheckUserType:admin,super_admin,user'],
    'as'=>'dashboard.',
    'prefix'=>'dashboard'
    ]
    ,function(){
// Route::get('/', [DashbordController::class,'index'])->name('dashboard');
Route::get('/categories/trash',[CategoriesController::class,'trash'])->name('categories.trash');
Route::put('/categories/{category}/restore',[CategoriesController::class,'restore'])->name('categories.restore');
Route::delete('/categories/{category}/force-delete',[CategoriesController::class,'forceDelete'])->name('categories.forcedelete');
Route::resource('categories',CategoriesController::class);
Route::resource('products',ProductsController::class);
});

