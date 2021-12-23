<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\TodoList;
use DB;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class TodoListController extends Controller
{
    public function index()
    {
        return TodoList::all('id', 'title')->toJson();
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required'
        ]);
        // if (TodoList::create(request()->all())) {
        // if ($todo = TodoList::create($attributes)) {
        //     return response('success')->json($todo);
        // } else
        //     return response('failed to create task', 500);

        $todo = TodoList::create($attributes);
        if ($todo ?? false) {
            return [
                'title' => $todo->title,
                'id' => $todo->id
            ];
        } else
            return response('failure', 401);
    }

    public function destroy(TodoList $todoList)
    {
        // return response($todoList->toJson());
        if ($todoList->delete())
            return response('success');
        else
            return response('failed to delete', 500);
    }

    public function getBooksByDate()
    {
        //? find all the books which has been borrowed at a given date
        $date = request('date');
        $date_start = now()->subMonth()->toDateString();
        $date_end = now()->toDateString();
        $books = DB::table('books')->select(['books.title', 'books.id', "borrowings.created_at as borrowed date", "borrowings.user_id as borrowed by"])->join('borrowings', 'borrowings.book_id', 'books.id')->where('borrowings.created_at', 'like', "%$date%")->get();
        return [$books->count(), $books];
    }

    public function addBorrowBook()
    {
        $attributes = request(['user_id', 'book_id']);
        $attributes['due_date'] = now();
        if ($borrowed = Borrowing::create($attributes))
            return response()->json(['message' => 'book borrowed successfully', 'borrowing' => $borrowed]);
        else
            return response(401);
    }
}

// $books = DB::table('books')->join('borrowings','borrowings.book_id','books.id');