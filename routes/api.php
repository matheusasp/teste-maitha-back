<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PermissionController;
use App\Http\Middleware\AuthCustom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


/* Login */
Route::post('/login', [LoginController::class, 'authenticate']);

/* Product */
//Route::get('/product/{id}', [ProductController::class, 'getProduct']);

/* User */
//Route::post('/user', [UserController::class, 'insertUser'])->middleware('isAdmin');

/* Auth Routes */
Route::middleware([AuthCustom::class])->prefix('auth')->group(function () {
    Route::controller(UserController::class)->group(function () {
            Route::post('create/user/{idUser}', [UserController::class, 'insertUser'])->middleware('isAdmin');
            Route::get('/all/user/{idUser}', [UserController::class, 'getAllUser']);
            Route::post('/update/user/{idUser}/{idUserUpdate}', [UserController::class, 'updateUser'])->middleware('isAdmin');
            Route::get('/user/{idUser}/{idUserSearch}', 'getUser')->middleware('isAdmin');
            Route::get('/user/status/{idUser}', 'statusActiveUser')->middleware('isAdmin');
            Route::delete('/delete/user/{idUser}/{idUserDelete}', 'deleteUser')->middleware('isAdmin');
        
        });

        Route::controller(UserController::class)->group(function () { 
            Route::get('/roles/{idUser}', [PermissionController::class, 'getAllRoles']);
            Route::post('/user/{idUser}/role/{roleId}', [PermissionController::class, 'assignRoleToUser']);

        });

        Route::controller(ProductController::class)->group(function () { 
            Route::get('/product/{idUser}/{id}', [ProductController::class, 'getProduct'])->middleware('isAdmin');
            Route::get('/all/product/{idUser}', [ProductController::class, 'getAllProduct']);
            Route::post('/create/product/{idUser}', 'insertProduct');
            Route::post('/update/product/{idUser}/{idProduct}', 'updateProduct')->middleware('isAdmin');
            Route::delete('/delete/product/{idUser}/{idProduct}', 'deleteProduct')->middleware('isAdmin');
        });

});

