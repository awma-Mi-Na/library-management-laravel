<?php

namespace App\Http\Controllers;

use App\Models\Borrowing_history;
use Carbon\Carbon;
use DB;
use Illuminate\Validation\Rule;

class SearchRecordsController extends Controller
{
    public function index()
    {
        return view('admin.search-records', ['results' => null]);
    }

    public function search()
    {
        $attributes = request()->validate([
            'title' => 'nullable',
            'name' => 'nullable',
            'borrowed_date' => ['nullable', 'date_format:Y-m-d']
        ]);

        $results = Borrowing_history::filter($attributes)->get();
        // dd($results->count());
        return view('admin.search-records', ['results' => $results]);
    }
}
