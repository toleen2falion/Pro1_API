<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
// use Illuminate\Http\Request;

Route::controller(PaymentController::class)
    ->prefix('pay')
    ->group(function(){
        Route::post('handle','handle')->name('pay.handle');
        Route::post('confirm', 'confirm')->name('pay.confirm');
        
    });