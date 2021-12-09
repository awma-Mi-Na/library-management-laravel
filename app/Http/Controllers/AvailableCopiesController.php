<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class AvailableCopiesController extends Controller
{
    public static function findCopies(Book $book)
    {
        $borrowed_copies = Borrowing::all()->where('book_id', $book->id)->count();
        $available_copies = $book->copies - $borrowed_copies;
        return $available_copies;
    }

    public function borrowedCopies(Book $book)
    {
        $borrowed_copies = Borrowing::all()->where('book_id', $book->id)->count();
        return $borrowed_copies;
    }
}
