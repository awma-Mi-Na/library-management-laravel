<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Borrowing_history;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::all()->where('user_id', auth()->user()->id);

        return view('user.index', ['borrowings' => $borrowings]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'book_id' => ['required', Rule::exists('books', 'id')],
        ]);
        $attributes['due_date'] = Carbon::create(now());
        Borrowing::create($attributes);
        Borrowing_history::create($attributes);
        return back()->with('success', 'Book has been added to borrowed');
    }

    public function show(Borrowing $borrowing)
    {
        return view('borrowing.show', ['borrowing' => $borrowing]);
    }
}
