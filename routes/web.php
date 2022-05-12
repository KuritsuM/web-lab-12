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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blogindex');

Route::get('/blog/{id}', [\App\Http\Controllers\BlogController::class, 'blogMain'])->name('blog');

Route::post('/blog', [\App\Http\Controllers\BlogController::class, 'createPost'])->name('createPost');

Route::get('/count', [\App\Http\Controllers\BlogController::class, 'countPosts'])->name('countPosts');

Route::match(['delete', 'get'], '/blog/delete/{id}', [\App\Http\Controllers\BlogController::class, 'deletePost'])->name('deletePost');

Route::match(['put', 'post'], 'blog/update/', [\App\Http\Controllers\BlogController::class, 'updatePost'])->name('updatePost');

require __DIR__.'/auth.php';
