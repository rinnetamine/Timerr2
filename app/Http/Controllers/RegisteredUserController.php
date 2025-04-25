<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        //validate!
        $attributes = request()->validate([
            'first_name' => 'required',
            'last_name'=> 'required',
            'email' => 'required|email',
            'password' =>  ['required', Password::min(6), 'confirmed']
        ]);

        
        // create the user in db
        $user = User::create($attributes);

        // log the user in
        Auth::login($user);

        // redirect to the home page
        return redirect('/jobs');
    }
}
