<?php

namespace App\Http\Controllers;

use App\Models\Book;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', ['books' => Book::all()]);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return back()->with('success', 'Book has been deleted');
    }
}
