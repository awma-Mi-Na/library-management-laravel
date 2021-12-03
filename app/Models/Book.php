<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $with = ['author'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters)
    {
        //? to filter results based on author
        $query->when($filters['author'] ?? false, function ($query, $author) {
            $query
                ->whereHas('author', function ($query) use ($author) {
                    $query
                        ->where('username', $author);
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
    }
}
