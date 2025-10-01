<?php

use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;
use Modules\Product\Http\Controllers\Admin\FamilyController;
use Modules\Product\Http\Controllers\Admin\CategoryController;
use Modules\Product\Http\Controllers\Admin\ProductController;
use Modules\Product\Http\Controllers\Admin\SubcategoryController;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('families', FamilyController::class);
Route::resource('categories', CategoryController::class);
 Route::resource('subcategories', SubcategoryController::class);
 Route::resource('products', ProductController::class);


 Route::get('/test-select', function () {
    return view('test-livewire-page');
})->name('test.select');