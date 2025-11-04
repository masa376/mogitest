<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MogiController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

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

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

Route::get('/products/search', [MogiController::class, 'index'])->name('products.search');

Route::get('/products/register', [MogiController::class, 'create'])->name('products.create');
Route::post('/products/register', [MogiController::class, 'store'])->name('products.store');

Route::get('/products/{product}', [MogiController::class, 'show'])->name('products.show');
Route::put('/products/{product}', [MogiController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [MogiController::class, 'destroy'])->name('products.destroy');

Route::get('/products/{product}/update', [MogiController::class, 'edit'])->name('products.edit');
Route::get('/products/{product}/update', [MogiController::class, 'update'])->name('products.update');
