<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }

    public function store (Request $request) 
    {
        //dd($request);

        // Modificar el request
        // $request->request->add(['username' => Str::slug($request->username)]);

        // Validate the user
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:50',
            'username' => 'required|unique:users|max:50',
            'password' => 'required|confirmed|min:6'
        ]);

        // Store the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => Str::slug($request->username),
            'password' => bcrypt($request->password),
            //'password' => Hash::make($request->password)
        ]);

        // Sign the user in
        auth()->attempt($request->only('email', 'password'));

        // Redirect
        return redirect()->route('posts.index', ['user' => auth()->user()->username]);
    }
}
