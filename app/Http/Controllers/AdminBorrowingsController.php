<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;

class AdminBorrowingsController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::all();
        return view('admin.borrowings', ['borrowings' => $borrowings]);
    }
}
