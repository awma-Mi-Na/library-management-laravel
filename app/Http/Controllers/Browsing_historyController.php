<?php

namespace App\Http\Controllers;

use App\Models\Borrowing_history;
use Illuminate\Http\Request;

class Browsing_historyController extends Controller
{
    public function index()
    {
        $histories = Borrowing_history::all()->where('user_id', auth()->user()->id);
        return view('borrowing.history-index', ['histories' => $histories]);
    }
}
