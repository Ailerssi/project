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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [\App\Http\Controllers\app\AppController::class, 'index'])->name('index');
Route::get('category/{category}', [\App\Http\Controllers\app\AppController::class, 'show_category'])->name('show_category');
Route::get('product/{product}', [\App\Http\Controllers\app\AppController::class, 'show_product'])->name('show_product');

Route::get('/query', [\App\Http\Controllers\app\SearchController::class, 'query'])->name('search.query');

Route::get('/cart', [\App\Http\Controllers\app\CartController::class, 'index'])->name('cartIndex');
Route::post('/add-to-cart', [\App\Http\Controllers\app\CartController::class, 'addToCart'])->name('addToCart');
Route::get('/clearCart', [\App\Http\Controllers\app\CartController::class, 'clearCart'])->name('clearCart');
Route::post('/order/create', [\App\Http\Controllers\OrderController::class, 'createOrder'])->name('order.create');

Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
    Route::get('/', [App\Http\Controllers\admin\HomeController::class, 'index'])->name('homeAdmin');

    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('post', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('product', \App\Http\Controllers\admin\ProductController::class);
    Route::resource('contactinfo', \App\Http\Controllers\admin\ContactInfoController::class);
    Route::put('product/{product}/hide', [\App\Http\Controllers\admin\ProductController::class, 'hide'])->name('product.hide');

});


