<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a form to register the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('register.index')->with('roles', $roles);
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
        $user->role_id = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if (!$user->save()) {
            return view('register.index');

        } else {
            return redirect('/');
        }
    }

    public function profile()
    {
        return view('profile.index', ['username' => ucfirst(Auth::user()->firstname . ' ' . Auth::user()->lastname), 'role' => ucfirst(Auth::user()->role->role), 'email' => Auth::user()->email]);
    }

    public function show() {
        return view('employees.index', ['employees' => User::with('role')->where('id', '!=', Auth::user()->id)->get()]);
    }

    public function resetpassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
            'oldpassword' => 'required|min:8'
        ]);
        $user = Auth::user();
        // Redirect the user back if the password is invalid
        if (!Hash::check($request->oldpassword, $user->password)) {
            return redirect()->back()->withErrors(['error' => 'A senha atual está incorreta']);
        }
        $user->password = bcrypt($request->password);
        $user->update(); //or $user->save();
        return redirect()->back()->with('status', 'Senha alterada com sucesso');

    }
}
