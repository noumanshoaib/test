<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'homeController@index');

Route::get('/register', 'registerController@index')->name('register');
Route::get('/login', 'loginController@index')->name('login');


use Illuminate\Support\Str;
Route::get('/test',function(){

   return bcrypt('admin');
});
