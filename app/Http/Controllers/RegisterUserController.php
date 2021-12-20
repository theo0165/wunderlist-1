<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterUserController extends Controller
{
    /*Show the form to create a new user.*/
    public function create()
    {
        return view('signup');
    }

    /* Store a new user.*/
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        $customMessages = [
            'required' => 'The :attribute field is required'
        ];
        $validation = $this->validate($request, $rules, $customMessages);

        $email = $validation['email'];
        $password = $validation['password'];


        $user = DB::table('users')->where('email', $email)->first();

        dd($user);

        return view('login')->with(['success' => 'Success!']);
    }
}
