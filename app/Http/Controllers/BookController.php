<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::filter(request(['author', 'search']))->get();
        return view('books.index', ['books' => $books]);
    }

    public function show(Book $book)
    {
        return view('books.show', ['book' => $book]);
    }
}
