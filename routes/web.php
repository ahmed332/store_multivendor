<?php

use App\Http\Controllers\Dashboard\DashbordController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/products',[ProductController::class,'index'])
->name('product.index');
Route::get('/products/{product:slug}',[ProductController::class,'show'])
->name('product.show');
Route::resource('cart',CartController::class);
Route::get('checkout',[CheckoutController::class,'create'])->name('checkout');
Route::post('checkout',[CheckoutController::class,'store'])->name('checkout.store');

// Route::get('/dashboard', [DashbordController::class,'index'])
// ->middleware(['auth', 'verified'])
// ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('orders/{order}/pay',[PaymentController::class,'create'])->name('orders.payments.create');
Route::post('orders/{order}/stripe/payment_intent',[PaymentController::class,'createStripePaymentIntent'])->
name('stripe.paymentIntent.create');
Route::get('orders/{order}/pay/stripe/callback', [PaymentController::class, 'confirm'])
    ->name('stripe.return');

    Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle']);

// require __DIR__.'/auth.php';
// require __DIR__.'/api.php';
require __DIR__.'/dashboard.php';

// Route::get('/',[HomeController::class,'index'])->name('home');
 Route::get('dashboard',[DashbordController::class,'index'])->name('dashboard')->middleware(['auth']);