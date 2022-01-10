<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class EditUserController extends Controller
{

    function uploadAvatarImage(Request $request)
    {
        $request->validate(['avatar-img' => 'image|required|max:3000']);

        $imageName = 'user' . auth()->id() . '-avatar.' . $request->file('avatar-img')->extension();
        $folderPath = storage_path('app/public/images');
        $request->file('avatar-img')->move($folderPath, $imageName);
        $imagePath = $imageName;
        User::where('id', auth()->id())->update(['avatar_img' => $imagePath]);
        return redirect()->route('profile');
    }

    function changeLogin(Request $request)
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

        User::where('id', auth()->id())->update(['email' => $request['email'], 'password' => Hash::make($request['password'])]);
        return redirect()->route('profile');
    }
}
