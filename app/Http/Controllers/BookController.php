<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::filter(request(['author', 'search', 'category', 'sortBy']))->paginate(9);
        $categories = Category::all();
        $authors = Author::all();
        $sort_options = ['popularity', 'most borrowed'];
        return view('books.index', ['books' => $books, 'categories' => $categories, 'authors' => $authors, 'sort_options' => $sort_options]);
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
        $categories = Category::all();
        return view('admin.add-book', ['authors' => $authors, 'categories' => $categories]);
    }

    public function store()
    {
        // dd(request()->input('category'));
        // $categories = request()->validate([
        //     'category.*' => 'nullable|exists:categories,title'
        // ]);

        // dd($categories);

        //! validate the entries and store them on books.
        // dd(request()->all());
        $attributes = request()->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
            'isbn' => ['required', Rule::unique('books', 'isbn'), 'digits:6'],
            'slug' => ['required', Rule::unique('books', 'slug')],
            'summary' => 'required|max:255',
            'copies' => 'required|numeric|min:1',
        ]);
        $categories = request()->validate([
            'category' => 'array|min:1|required',
            'category.*' => 'nullable|exists:categories,id'
        ]);
        $book = Book::create($attributes);
        foreach ($categories['category'] as $category_id) {
            BookCategory::create(['book_id' => $book->id, 'category_id' => $category_id]);
        }
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

    // public static function sortBooks($option)
    // {
    //     switch ($option) {
    //         case '1':
    //             echo ('hello');
    //             break;
    //         case '2':
    //             echo ('bye');
    //             break;
    //         default:
    //             echo ('default');
    //             break;
    //     }
    // }
}
