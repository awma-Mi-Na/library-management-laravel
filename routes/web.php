<?php

use App\Http\Controllers\AdminAddBookController;
use App\Http\Controllers\AdminBorrowingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Models\Borrowing;
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
Route::get('admin/borrowings', [AdminBorrowingsController::class, 'index'])->middleware('isAdmin');
Route::get('admin/add-book', [BookController::class, 'create'])->middleware('isAdmin');
Route::post('admin/add-book', [BookController::class, 'store'])->middleware('isAdmin');

//? books controller
Route::get('/books/{book:slug}', [BookController::class, 'show']);

//? user controller
Route::get('user/{user:username}', [UserController::class, 'show'])->middleware('auth');

//? borrowing controller
Route::get('borrowings', [BorrowingController::class, 'index'])->middleware('auth');
Route::post('borrowings', [BorrowingController::class, 'store'])->middleware('auth');
Route::get('borrowings/{borrowing}', [BorrowingController::class, 'show'])->middleware('auth');

//! for testing
Route::get('test', function () {
    $now = now()->addDays(95);
    $due_dates = Borrowing::select('id', 'due_date')->where('user_id', auth()->user()->id)->get()->toArray();
    $late_fees = [];
    foreach ($due_dates as $due_date) {
        $late_fees[$due_date['id']] = 0;
        $late_days = $due_date['due_date']->diffInDays($now);
        dump($late_days);
        if ($late_days > 0) {
            // while ($late_days > 0) {
            // $late_fees[$due_date['id']] += $late_rate[$i] * ($late_days - $late_days % 10);
            // dump($late_fees[$due_date['id']]);
            // $late_days -= 10;
            // if ($i < 2){
            //     $late_fees[$due_date['id']] += $late_rate[$i] * 
            //     ++$i;
            // }
            if ($late_days <= 10) {
                $late_fees[$due_date['id']] += 2 * $late_days % 11;
            }
            if ($late_days <= 20) {
                $late_days -= 10;
                $late_fees[$due_date['id']] += 5 * $late_days % 11 + 20;
            }
            if ($late_days > 20) {
                $late_days -= 20;
                $late_fees[$due_date['id']] += 10 * $late_days + 70;
            }
            // }
        }
    }
    dd($late_fees);
});
