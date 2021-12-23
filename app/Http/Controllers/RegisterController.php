<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUser;
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

    public function store(RegisterUser $request)
    {
        dd($request->all());
        $user = User::create($request->all());

        Auth::login($user);

        Session::flash('success', 'Your account has been created');

        return redirect('/');
        // dd($user);
    }
}
