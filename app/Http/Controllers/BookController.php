<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::filter(request(['author', 'search', 'category']))->paginate(9);
        $categories = Category::all();
        $authors = Author::all();
        return view('books.index', ['books' => $books, 'categories' => $categories, 'authors' => $authors]);
    }

    public function show(Book $book)
    {
        if (auth()->user())
            $isBorrowed = $book->borrowings->contains('user_id', auth()->user()->id);
        $isCopyAvailable = AvailableCopiesController::findCopies($book) > 0;
        // dd($isBorrowed, $isCopyAvailable);
        // if ($user_id = auth()->user()->id) {
        //     $isBorrowed = $book->borrowings->contains('user_id', $user_id);
        // }
        return view('books.show', ['book' => $book, 'isBorrowed' => $isBorrowed ?? false, 'isCopyAvailable' => $isCopyAvailable]);
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
            'copies' => 'required|numeric|min:1'
        ]);
        Book::create($attributes);
        return back()->with('success', 'Book has been added');
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('admin.edit-book', ['book' => $book, 'authors' => $authors]);
    }

    public function update(Book $book)
    {
        $attributes = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('books')->ignore($book->id)],
            'isbn' => ['required', Rule::unique('books', 'isbn')->ignore($book->id), 'digits:6'],
            'author_id' => ['required', Rule::exists('authors', 'id')],
            'summary' => ['required'],
            'copies' => ['required', 'numeric']
        ]);

        // dd($attributes);

        $book->update($attributes);
        return back()->with('success', 'Book details updated successfully');
    }

    public static function findCategories(Book $book)
    {
        return $book->book_categories->pluck('category')->pluck('title')->toArray();
    }
}
