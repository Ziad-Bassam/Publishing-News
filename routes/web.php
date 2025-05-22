<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
    return view('welcome');
});

// route name help to (DRY)

Route::get('/posts', [PostController::class, 'index'])->name(name: 'posts.index');

Route::get('/posts/create', [PostController::class, 'create'])->name(name: 'posts.create');

Route::post('/posts', [PostController::class, 'store'])->name(name: 'posts.store');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name(name: 'posts.edit');

Route::get('/posts/{post}', [PostController::class, 'show'])->name(name: 'posts.show');

Route::put('/posts/{post}', [PostController::class, 'update'])->name(name: 'posts.update');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name(name: 'posts.destroy');


// echo TestController::class . "<br>";

// Route::get('/test', [TestController::class, 'firstAction']);
   //!OR
// Route::get('/test2', ['App\Http\Controllers\TestController', 'firstAction']);
