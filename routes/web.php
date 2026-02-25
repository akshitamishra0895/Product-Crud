<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/product');
});
Route::get('/product', 'App\Http\Controllers\ProductController@index');
Route::post('/add-product', 'App\Http\Controllers\ProductController@store');
Route::post('/update-product', 'App\Http\Controllers\ProductController@update');
Route::delete('/delete-product/{id}', 'App\Http\Controllers\ProductController@destroy');
Route::delete('/delete-product-image/{id}', 'App\Http\Controllers\ProductController@destroyImage');
Route::get('/product-list-ajax', 'App\Http\Controllers\ProductController@ajaxList');
