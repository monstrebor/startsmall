<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            session()->forget('url.intended');

            $user = Auth::user();

            if ($user->status === 'inactive') {
                Auth::logout();
                return back()->with('error', 'Your account is currently inactive. Please contact support.');
            }

            $role = $user->getRoleNames()->first();

            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('success', 'Welcome, Admin!');
                case 'cashier':
                    return redirect()->route('cashier.dashboard')->with('success', 'Welcome, Cashier!');
                default:
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Unauthorized role.');
            }
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }
}
