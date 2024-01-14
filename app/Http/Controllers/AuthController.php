<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\StoreUserController;
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

    public function register_store(StoreUserController $request)
    {
        $user = User::create($request->validated());
        Auth::login($user);
        // event(new Registered($user));

        return redirect()->route('listing.index')->with('success', 'Welcome '.$request->name.'!');
    }

    public function verification(Request $request)
    {
        event(new Registered(Auth::user()));
        return inertia('Auth/VerifyEmail');
    }

    public function resend_verification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return redirect()->back()->with('success', 'Verification link has been sent to your email!');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
