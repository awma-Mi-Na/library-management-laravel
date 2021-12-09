<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Borrowing_history;
use Carbon\Carbon;
use DB;
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
        $borrowing = Borrowing::create($attributes);
        // Book::find($borrowing->book_id)->decrement('copies');

        $attributes = array_merge($attributes, ['status' => 0, 'borrowing_id' => $borrowing->id]);
        Borrowing_history::create($attributes);
        return back()->with('success', 'Book has been added to borrowed');
    }

    public function show(Borrowing $borrowing)
    {
        return view('borrowing.show', ['borrowing' => $borrowing]);
    }

    //? refers to returning a book, status is marked as '1' in corresponding record on borrowing_history table
    public function destroy(Borrowing $borrowing)
    {
        Borrowing::destroy($borrowing->id);
        DB::table('borrowing_histories')->where('borrowing_id', $borrowing->id)->update(['status' => 1, 'returned_date' => now()]);
        return redirect('/borrowings')->with('success', 'Book has been returned');
    }
}
