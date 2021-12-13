<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
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
}
