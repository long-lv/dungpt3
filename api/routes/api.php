<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\user\UserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/admin/singup', [AdminController::class,'singUp']);
Route::post('/auth/admin/login', [AdminController::class,'login']);
Route::get('/auth/admin/logout',[AdminController::class, 'logout']);
Route::group(['prefix'=>'admin'],function (){
    Route::apiResource('list',AdminController::class);
    Route::apiResource('product',ProductController::class);
    Route::apiResource('category',CategoryController::class);
});
Route::post('/auth/user/singup', [UserController::class,'singUp']);
Route::post('/auth/user/login', [UserController::class,'login']);
