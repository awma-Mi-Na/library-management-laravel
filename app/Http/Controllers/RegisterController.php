<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;

class RegisterController extends Controller
{
    public function create()
    {
        return view('user.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'username' => ['required', "max:255", 'min:5', Rule::unique('users', 'username')],
            'name' => 'required|max:255|min:4',
            'email' => 'email|max:255|min:5',
            'password' => 'required'
        ]);
        // dd($attributes);
        $user = User::create($attributes);

        Auth::login($user);

        Session::flash('success', 'Your account has been created');

        return redirect('/');
        // dd($user);
    }
}
