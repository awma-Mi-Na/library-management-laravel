<?php

use App\Http\Controllers\AdminAddBookController;
use App\Http\Controllers\AdminBorrowingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRecordsController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\BorrowingHistoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchRecordsController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Borrowing_history;
use Carbon\Carbon;
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
Route::get('login', [SessionsController::class, 'create'])->name('login');
Route::post('login', [SessionsController::class, 'store']);
Route::post('logout', [SessionsController::class, 'destroy']);

//? admin controller
Route::get('admin/books', [AdminController::class, 'index'])->middleware('isAdmin');
Route::delete('admin/books/{book}', [AdminController::class, 'destroy'])->middleware('isAdmin');
Route::get('admin/records', AdminRecordsController::class)->middleware('isAdmin');
Route::get('admin/search-records', [SearchRecordsController::class, 'index'])->middleware('isAdmin');
Route::post('admin/search-records', [SearchRecordsController::class, 'search'])->middleware('isAdmin');
Route::get('admin/edit-book/{book}', [BookController::class, 'edit'])->middleware('isAdmin');
Route::patch('admin/edit-book/{book}', [BookController::class, 'update'])->middleware('isAdmin');

//? books controller
Route::get('/books/{book:slug}', [BookController::class, 'show']);

//? user controller
// Route::get('user/{user:username}', [UserController::class, 'show'])->middleware('auth');

//? borrowing controller
Route::get('borrowings', [BorrowingController::class, 'index'])->middleware('auth');
Route::post('borrowings', [BorrowingController::class, 'store'])->middleware('auth');
Route::get('borrowings/{borrowing}', [BorrowingController::class, 'show'])->middleware('auth');
Route::delete('borrowings/{borrowing}', [BorrowingController::class, 'destroy'])->middleware('auth');
Route::get('borrowings-history', BorrowingHistoryController::class)->middleware('auth');

//? add book endpoint
Route::get('admin/add-book', [BookController::class, 'create'])->middleware('isAdmin');
Route::post('admin/add-book', [BookController::class, 'store'])->middleware('isAdmin');

//? add author endpoint
Route::get('admin/add-author', [AuthorController::class, 'create'])->middleware('isAdmin');
Route::post('admin/add-author', [AuthorController::class, 'store'])->middleware('isAdmin');

//! for testing
Route::get('test', function () {
    $books = Book::all()->groupBy('author_id');
    dd($books[2]);
});
