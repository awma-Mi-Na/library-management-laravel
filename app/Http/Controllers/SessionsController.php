<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Session;

class SessionsController extends Controller
{
    public function create()
    {
        return view('user.login');
    }
    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', Rule::exists('users', 'email')],
            'password' => ['required']
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages(['email' => 'The provided credentials could not be verified']);
        }

        Session::regenerate();
        return redirect('/')->with('success', 'Welcome back ' . auth()->user()->username);
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Goodbye.');
    }
}
