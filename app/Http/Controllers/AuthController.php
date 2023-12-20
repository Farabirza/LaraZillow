<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return inertia('Auth/Login');
    }

    public function authenticate(Request $request)
    {
        if(!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]), true)) {
            throw ValidationException::withMessages([
                'email' => 'Authentication failed'
            ]);
        }
        $request->session()->regenerate();

        return redirect()->intended('/listing');
    }

    public function register()
    {
        return inertia('Auth/Register');
    }

    public function register_store(Request $request)
    {
        $user = User::create($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]));
        Auth::login($user);

        return redirect()->route('listing.index')->with('success', 'Welcome '.$request->name.'!');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
