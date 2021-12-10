<?php

namespace App\Models;

use App\Models\Book as ModelsBook;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $with = ['author'];

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

    public function scopeFilter($query, array $filters)
    {
        //? to filter results based on author
        $query->when($filters['author'] ?? false, function ($query, $author) {
            $query
                ->whereHas('author', function ($query) use ($author) {
                    $query
                        ->where('name', 'like', '%' . $author . '%');
                });
        });

        //? to filter results based on search
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query
                ->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', '%' . $search . '%');
                });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->where(function ($query) use ($category) {
            });
        });
    }
}
