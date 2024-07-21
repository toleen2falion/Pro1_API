<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CategoryController,
    ProductController,
    OrderController,
    RoleController,
    PaymentController
};


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

$api_path ='/Api/';
Route::prefix('api')->group(function() use ($api_path){
   
  
    
    Route::apiResource('orders',OrderController::class);
    //
    Route::middleware('auth:sanctum')
            ->group(function(){
                Route::apiResource('categories',CategoryController::class);
                Route::apiResource('products',ProductController::class);
            });

    // Route::post('handle', [PaymentController::class, 'handle']);
    // Route::post('confirm', [PaymentController::class, 'confirm']);
    include __DIR__ . "{$api_path}Auth.php";
    include __DIR__ . "{$api_path}Pay.php";
});

