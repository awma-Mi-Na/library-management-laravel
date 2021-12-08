<?php

namespace App\Http\Controllers;

use App\Models\Borrowing_history;
use Illuminate\Http\Request;

class BorrowingHistoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $histories = Borrowing_history::all()->where('user_id', auth()->user()->id);
        return view('user.borrowing-history', ['histories' => $histories]);
    }
}
