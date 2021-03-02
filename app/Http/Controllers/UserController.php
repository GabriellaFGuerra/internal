<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a form to register the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'role' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = new User;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if (!$user->save()) {
            return view('register.index');

        } else {
            return redirect('/');
        }
    }
}
