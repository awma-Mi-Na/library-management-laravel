<?php

namespace App\Http\Controllers;

use App\Models\Borrowing_history;
use Illuminate\Http\Request;

class AdminRecordsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $records = Borrowing_history::paginate(10);
        return view('admin.records', ['records' => $records]);
    }
}
