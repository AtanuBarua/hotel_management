<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
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

    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed'
            ]);

            try {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);

                $user->assignRole(User::ROLE_OWNER);
                Auth::login($user);
                return redirect()->route('owner.dashboard');
            } catch (\Throwable $th) {
                \Log::error('ERROR_REGISTERING_OWNER: ' . $th->getMessage());
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } else {
            return view('owner.register');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('owner.login');
    }
}
