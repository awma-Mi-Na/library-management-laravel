<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $with = ['author', 'borrowings'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function borrowing_histories()
    {
        return $this->hasMany(Borrowing_history::class);
    }

    public function book_categories()
    {
        return $this->hasMany(BookCategory::class);
    }

    // public function scopeFilter($query, array $filters)
    // {
    //     //? to filter results based on author
    //     $query->when($filters['author'] ?? false, function ($query, $author) {
    //         $query
    //             ->whereHas('author', function ($query) use ($author) {
    //                 $query
    //                     ->where('name', 'like', '%' . $author . '%');
    //             });
    //     });

    //     //? to filter results based on search
    //     $query->when($filters['search'] ?? false, function ($query, $search) {
    //         $query
    //             ->where(function ($query) use ($search) {
    //                 $query
    //                     ->where('title', 'like', '%' . $search . '%');
    //             });
    //     });

    //     //? check if a book belongs to a category, how? a book has many categories, get all the category titles of the book, then check if there exists a title like filters['category']
    //     // $query->when($filters['category'] ?? false, function ($query, $category) {
    //     //     $book_ids = DB::table('book_categories')->whereExists(function () use ($category) {
    //     //         DB::table('categories')->where('id',);
    //     //     });
    //     //     $query->whereIn('id',);
    //     // });

    //     $query->when($filters['category'] ?? false, function ($query, $category) {
    //         $query
    //             ->where(function ($query) use ($category) {
    //                 $query->whereHas('book_categories', function ($query) use ($category) {
    //                     $query->whereHas('category', function ($query) use ($category) {
    //                         $query->where('title', 'like', '%' . $category . '%');
    //                     });
    //                 });
    //             });
    //     });

    //     $query->when($filters['sortBy'] ?? false, function ($query, $sortBy) {
    //         $query
    //             ->where(function ($query) use ($sortBy) {
    //                 switch ($sortBy) {
    //                     case 'popularity':
    //                         $popularity_index = $this->selectRaw("books.id,count(borrowing_histories.book_id) as 'times borrowed'")->leftJoin('borrowing_histories', 'books.id', 'borrowing_histories.book_id')->groupByRaw('books.id')->orderByDesc('times borrowed')->get()->pluck('id')->toArray();
    //                         $popularity_index_order = implode(',', $popularity_index);
    //                         // dump($popularity_index_order);
    //                         $query->whereIn('id', $popularity_index)->orderByRaw("FIELD(books.id,$popularity_index_order)");
    //                         break;

    //                     case 'latest':
    //                         $query->latest()->get();
    //                         // dump($query->latest()->get());
    //                         break;

    //                     case 'oldest':
    //                         $query->oldest()->get();
    //                         // dump($query->oldest()->get());
    //                         break;

    //                     default:
    //                         break;
    //                 }
    //             });
    //     });
    // }
}
