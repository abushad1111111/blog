<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MarqueController;

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

Route::group(['prefix' => 'blog'], function () {
    Route::get('/list', [BlogController::class, 'blogList'])->name('blog.list');
    Route::get('/form', [BlogController::class, 'blogForm'])->name('blog.form');
    Route::post('/create', [BlogController::class, 'blogCreate'])->name('blog.create');
    Route::get('/edit/{id}', [BlogController::class, 'blogEdit'])->name('blog.edit');
    Route::put('/update/{id}', [BlogController::class, 'blogUpdate'])->name('blog.update');
    Route::delete('/destroy/{id}', [BlogController::class, 'blogDestroy'])->name('blog.destroy');
});

Route::group(['prefix' => 'marque'], function () {
    Route::get('/list', [MarqueController::class, 'marqueList'])->name('marque.list');
    Route::get('/form', [MarqueController::class, 'marqueForm'])->name('marque.form');
    Route::post('/create', [MarqueController::class, 'marqueCreate'])->name('marque.create');
    Route::delete('/destroy/{id}', [MarqueController::class, 'marqueDestroy'])->name('marque.destroy');
});