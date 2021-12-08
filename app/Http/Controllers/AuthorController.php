<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    public function create()
    {
        return view('admin.add-author');
    }

    public function store()
    {
        if (!request()->filled(['username'])) {
            $attributes = request()->validate([
                'name' => 'required',
                'username' => 'nullable'
            ]);
        } else {
            $attributes = request()->validate([
                'username' => 'required|exists:users,username',
                'name' => ['required', Rule::exists('users', 'name')->where('username', request(['username']))]
            ]);
            $attributes['user_id'] = User::where('username', $attributes['username'])->pluck('id')->toArray()[0];
        }

        unset($attributes['username']);
        Author::create($attributes);
        return back()->with('success', 'Author has been added');
    }
}
