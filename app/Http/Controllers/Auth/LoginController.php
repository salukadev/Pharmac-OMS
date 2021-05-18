<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return Inertia::render('Login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->userType == 'Admin'){
                return redirect()->intended('/dashboard/Admin');
            }else{
                return redirect()->intended('/dashboard');
            }
            error_log("auth successful.....................");
        }
        error_log("auth failed.....................");
        return redirect('login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    public function logout() {
        error_log("Logging out.....................");
        Auth::logout();
        return redirect('login');
    }
}
