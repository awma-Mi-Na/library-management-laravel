<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
use DB;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::when(request('author') ?? false, function ($query, $author) {
            $query->whereHas('author', function ($query) use ($author) {
                $query->where('name', 'like', '%' . $author . '%');
            });
        })
            ->when(request('category') ?? false, function ($query, $category) {
                $query->where(function ($query) use ($category) {
                    $query->whereHas('book_categories', function ($query) use ($category) {
                        $query->whereHas('category', function ($query) use ($category) {
                            $query->where('title', 'like', '%' . $category . '%');
                        });
                    });
                });
            })
            ->when(request('search') ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                });
            })
            ->when(request('sortBy') == 'latest', function ($query) {
                $query->latest();
            })
            ->when(request('sortBy') == 'oldest', function ($query) {
                $query->oldest();
            })
            ->when(request('sortBy') == 'popularity', function ($query) {

                //? get left join of books and borrowing_histories, then get the count of book_id in borrowing_histories and select all the book ids with their corresponding counts in borrowing histories. [note: left join is useful here because we can include count of 0 for those book_id's which are not present in borrowing_histories]
                $popularity_index = Book::selectRaw("books.id,count(borrowing_histories.book_id) as 'times borrowed'")
                    ->leftJoin('borrowing_histories', 'books.id', 'borrowing_histories.book_id')
                    ->groupByRaw('books.id')
                    ->orderByDesc('times borrowed')
                    ->get()->pluck('id')->toArray();
                $popularity_index_order = implode(',', $popularity_index);

                $query
                    ->whereIn('id', $popularity_index)
                    ->orderByRaw("FIELD(id,$popularity_index_order)");
            })->paginate(9);

        $categories = Category::all();
        $authors = Author::all();
        $sort_options = ['popularity', 'latest', 'oldest'];
        return view('books.index', ['books' => $books, 'categories' => $categories, 'authors' => $authors, 'sort_options' => $sort_options]);
    }

    public function show(Book $book)
    {
        if (auth()->user())
            $isBorrowed = $book->borrowings->contains('user_id', auth()->user()->id);
        $isCopyAvailable = AvailableCopiesController::findCopies($book) > 0;
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
        $attributes = request()->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
            'isbn' => ['required', Rule::unique('books', 'isbn'), 'digits:6'],
            'slug' => ['required', Rule::unique('books', 'slug')],
            'summary' => 'required|max:255',
            'copies' => 'required|numeric|min:1',
        ]);
        $categories = request()->validate(
            [
                'category' => 'array|min:1|required',
                'category.*' => 'nullable|exists:categories,id'
            ],
            [
                'category.*.exists' => 'The selected category does not exist'
            ]
        );
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

        $book->update($attributes);
        return back()->with('success', 'Book details updated successfully');
    }

    public static function findCategories(Book $book)
    {
        return $book->book_categories->pluck('category')->pluck('title')->toArray();
    }
}
