<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('register','registerController');
Route::apiResource('login','loginController');
Route::apiResource('product','productController');
Route::apiResource('order','orderController');


Route::group(['prefix' => 'admin'],function(){
    Route::apiResource('user','Admin\UserController');
    Route::apiResource('login','Admin\LoginController');
    Route::apiResource('order','Admin\OrderController');
    Route::apiResource('product','Admin\ProductController');
});