<?php

use App\Http\Controllers\AuthUserController;
use Illuminate\Support\Facades\Route;
// use Illuminate\Http\Request;

Route::controller(AuthUserController::class)
    ->prefix('auth')
    ->group(function(){

        Route::middleware('guest:sanctum')
            ->group(function(){
                Route::post('Signup','createUser')->name('auth.Signup');
                Route::post('login', 'loginUser')->name('auth.loginUser');
            }); 

        Route::middleware('auth:sanctum')
            ->group(function(){
                Route::get('logout','logout')->name('auth.logout');
            });
        
    });