<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LogInUserController extends Controller
{
    function __invoke(Request $request)
    {
        //Validation rules
        $rules = [
            'email' => 'required', //|email?
            'password' => 'required',
        ];
        $customMessages = [
            'required' => 'The :attribute field is required'
        ];
        //Validate, throws errors and returns if fails.
        $validation = $this->validate($request, $rules, $customMessages);

        $email = $validation['email'];
        $password = $validation['password'];

        //Check if there is a user in the db with that email.
        $user = User::where('email', $email)->first();
        if ($user === null) {
            //No user, do something
            return '404';
        }

        $passwordIsCorrect = Hash::check($password, $user->password);

        if ($passwordIsCorrect) {
            return view('profile');
        }
        //Update this later
        return 'Wrong password';
    }
}
