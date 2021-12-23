<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required', "max:255", 'min:5', Rule::unique('users', 'username')],
            'name' => 'required|max:255|min:4',
            'email' => 'email|max:255|min:5|unique:users,email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => 'i username hman tum hi midangin an hmang tawh a, khawngaihin a dang hmang mai ta che',
        ];
    }
}
