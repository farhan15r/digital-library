<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Models\Category;

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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [UserController::class, 'index'])->name('register');
    Route::post('/register', [UserController::class, 'store']);
});

Route::middleware(['auth'])->group(function() {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [BookController::class, 'index'])->name('home');
    Route::resource('/books', BookController::class)->name('*', 'books');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/categories', CategoryController::class)->name('*', 'categories')->except(['show']);
});
