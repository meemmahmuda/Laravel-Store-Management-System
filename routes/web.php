<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\CategoriesController;
use \App\Http\Controllers\BrandsController;
use \App\Http\Controllers\SizesController;
use \App\Http\Controllers\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


Route::middleware(['auth:sanctum'])->group(function(){
    // Category
Route::resource('categories',CategoriesController::class);

    // Brand
Route::resource('brands',BrandsController::class);

    // Size
    Route::resource('sizes',SizesController::class);

    // Product
    Route::resource('products',ProductsController::class);

});

});
