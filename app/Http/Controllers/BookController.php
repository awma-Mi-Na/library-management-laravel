<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
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
        $isBorrowed = $book->borrowings->contains('book_id', $book->id);
        // if ($user_id = auth()->user()->id) {
        //     $isBorrowed = $book->borrowings->contains('user_id', $user_id);
        // }
        return view('books.show', ['book' => $book, 'isBorrowed' => $isBorrowed]);
    }

    public function create()
    {

        $authors = Book::select('user_id')->distinct()->get();
        return view('admin.add-book', ['authors' => $authors]);
    }

    public function store()
    {
        //! validate the entries and store them on books.
    }
}
