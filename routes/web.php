<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders/pay', [PaymentController::class, 'createPay'])
->name('orders.payments.create');

Route::post('/orders/stripe/payment-intent', [PaymentController::class, 'createStripePaymentIntent'])
->name('stripe.paymentIntent.create');

Route::post('/orders/stripe', [PaymentController::class, 'confirm'])
->name('stripe.return');