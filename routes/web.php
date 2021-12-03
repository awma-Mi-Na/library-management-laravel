<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
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

//? get all books and display them on home page
Route::get('/', [BookController::class, 'index']);

//? Register user
Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

//? login/logout user
Route::get('login', [SessionsController::class, 'create']);
Route::post('login', [SessionsController::class, 'store']);
Route::post('logout', [SessionsController::class, 'destroy']);

//? admin controller
Route::get('admin', [AdminController::class, 'index'])->middleware('isAdmin');

//? books controller
Route::get('/books/{book:slug}', [BookController::class, 'show']);


//! for testing
Route::get('/test', function () {
    return 'hello';
})->middleware('isAdmin');
