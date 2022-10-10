<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\AuthCustom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


/* Login */
Route::post('/login', [LoginController::class, 'authenticate']);

/* Product */
Route::get('/product/{id}', [ProductController::class, 'getProduct']);

/* User */
Route::post('/user', [UserController::class, 'insertUser']);

/* Auth Routes */
Route::middleware([AuthCustom::class])->prefix('auth')->group(function () {
    Route::controller(UserController::class)->group(function () {
            Route::post('/update/user/{id}', [UserController::class, 'updateUser']);
            Route::get('/user/{id}', 'getUser');
            Route::delete('/user/status/{id}', 'statusActiveUser');
            Route::delete('/delete/user/{id}', 'deleteUser');
        
        });
        Route::controller(ProductController::class)->group(function () { 
            Route::post('/create/product', 'insertProduct');
            Route::post('/update/product/{id}', 'updateProduct');
            Route::delete('/product/delete/{id}', 'deleteProduct');
        });

});

