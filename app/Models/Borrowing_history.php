<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing_history extends Model
{
    use HasFactory;

    public function borrower()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function borrows()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function setDueDateAttribute($due_date)
    {
        $this->attributes['due_date'] = $due_date->addMonth();
    }

    public function getDueDateAttribute($due_date)
    {
        return Carbon::parse($due_date);
    }

    public function getReturnedDateAttribute($returned_date)
    {
        if ($returned_date)
            return Carbon::parse($returned_date);
        else
            return;
    }

    public function scopeFilter($query, array $terms)
    {
        $query->when($terms['title'] ?? false, function ($query, $title) {
            $book_id = DB::table('books')->select('id')->where('title', 'like', '%' . $title . '%')->pluck('id')->toArray();
            // $query->where(function ($query) use ($book_id) {

            $query->orWhereIn('book_id', $book_id);
            // });
        });

        $query->when($terms['name'] ?? false, function ($query, $name) {
            $user_id = DB::table('users')->select('id')->where('name', 'like', '%' . $name . '%')->pluck('id')->toArray();
            // dd($user_id);
            $query->orWhereIn('user_id', $user_id);
        });

        $query->when($terms['borrowed_date'] ?? false, function ($query, $borrowed_date) {
            $borrowed_date = Carbon::createFromFormat('d/m/Y', $borrowed_date)->toDateString();
            $query->orWhere('created_at', 'like', $borrowed_date . '%');
        });
    }
}

// Carbon::createFromFormat('d/m/Y','01/12/2021');