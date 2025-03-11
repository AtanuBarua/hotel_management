<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function login() {
    //     return view('owner.login');
    // }

    public function login(Request $request) {
        if ($request->isMethod('POST')) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('owner.dashboard');
            }

            return back()->withErrors([
                'error' => 'Invalid credentials.',
            ])->onlyInput('email');
        } else {
            return view('owner.login');
        }

    }

    public function register(Request $request) {
        if ($request->isMethod('POST')) {
            # code...
        } else {
            return view('owner.register');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('owner.login');
    }
}
