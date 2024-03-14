<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function store (Request $request) 
    {
        //dd($request);
        // Validate the user
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:50',
            'username' => 'required|unique:users|max:50',
            'password' => 'required|confirmed|min:6'
        ]);

        // Store the user
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'username' => $request->get('username'),
            'password' => bcrypt($request->get('password')),
        ]);

        // Sign the user in
        //auth()->attempt($request->only('email', 'password'));

        // Redirect
        return redirect()->route('home');
    }
}
