<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        //Validation rules
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'confirmed', 'min:6', 'max:255']
        ];
        $customMessages = [
            'required' => 'The :attribute field is required'
        ];
        //Validate, throws errors and returns if fails.
        $inputData = $this->validate($request, $rules, $customMessages);

        //Check if there is a user in the db with that email already.
        $user = User::where('email', $inputData['email'])->first();
        if ($user !== null) {
            //If user already exist, throw error and return.
            //This loads the view, but the url is wrong, because the form is posting to start page.. Fix somehow.
            return view('signup')->with(['userexisterror' => 'Email is already registered.']);
        }

        //If user doesn't exist, create new user and save to db.
        $user = new User;
        $user->email = $inputData['email'];
        $user->password = Hash::make($inputData['password']);
        $user->avatar_img = '';
        $user->save();

        return view('login')->with(['success' => 'Success!']);
    }
}
