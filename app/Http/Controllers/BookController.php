<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

        $authors = Author::all();
        return view('admin.add-book', ['authors' => $authors]);
    }

    public function store()
    {
        //! validate the entries and store them on books.
        $attributes = request()->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
            'isbn' => ['required', Rule::unique('books', 'isbn'), 'digits:6'],
            'slug' => ['required', Rule::unique('books', 'slug')],
            'summary' => 'required|max:255',
        ]);
        dd($attributes);
        // Book::create($attributes);
        return back()->with('success', 'Book has been added');
    }
}
