<?php

use App\Http\Controllers\{CategoryController, ActionController};
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create',[CategoryController::class, 'create'])->name('category.create');
Route::post('/category',[CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}/edit',[CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}',[CategoryController::class, 'update'])->name('category.update');
Route::get('/category/{id}',[CategoryController::class, 'show'])->name('category.show');
Route::delete('category/{id}',[CategoryController::class, 'destroy'])->name('category.destroy');
*/
Route::resource('category',CategoryController::class);
Route::resource('action',ActionController::class);