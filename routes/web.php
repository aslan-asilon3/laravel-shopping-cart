<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('product', [ProductController::class, 'index']);  

Route::get('product/cart', [ProductController::class, 'cart'])->name('cart');

Route::get('product/add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');

Route::patch('product/update-cart', [ProductController::class, 'update'])->name('update.cart');

Route::delete('product/remove-from-cart', [ProductController::class, 'remove'])->name('remove.from.cart');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
