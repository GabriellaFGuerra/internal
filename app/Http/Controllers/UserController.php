<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        return view('register.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'role' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'role_id' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home');
    }

    public function profile()
    {
        return view('profile.index', [
            'username' => ucfirst(Auth::user()->firstname . ' ' . Auth::user()->lastname),
            'role' => ucfirst(Auth::user()->role->role),
            'email' => Auth::user()->email,
        ]);
    }

    public function show()
    {
        return view('employees.index', [
            'employees' => User::with('role')->where('id', '!=', Auth::user()->id)->get(),
        ]);
    }

    public function resetpassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
            'oldpassword' => 'required|min:8'
        ]);

        $user = User::where('id', Auth::user()->id)->first();

        // Redirect the user back if the password is invalid
        if (!Hash::check($request->oldpassword, $user->password)) {
            return redirect()->back()->withErrors(['error' => 'A senha atual está incorreta']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('status', 'Senha alterada com sucesso');
    }
}

