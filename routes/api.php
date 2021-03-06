<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('todo', [TodoListController::class, 'store']);
Route::get('todo', [TodoListController::class, 'index']);
Route::delete('todo/{todoList}', [TodoListController::class, 'destroy']);

Route::get('books', [TodoListController::class, 'getBooksByDate']);
Route::post('borrow', [TodoListController::class, 'addBorrowBook']);
