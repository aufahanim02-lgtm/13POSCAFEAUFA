<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerAuthUser extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // redirect berdasarkan role
            if (Auth::user()->role == 'owner') {
                return redirect('/dashboardowner')->with('success', 'Login berhasil sebagai Owner');
            } elseif (Auth::user()->role == 'manager') {
                return redirect('/dashboardmanager')->with('success', 'Login berhasil sebagai Manager');
            } elseif (Auth::user()->role == 'kasir') {
                return redirect('/dashboardkasir')->with('success', 'Login berhasil sebagai Kasir');
            } else {
                Auth::logout();
                return redirect('/login')->with('error', 'Role tidak valid!');
            }
        }

        return redirect('/login')->with('error', 'Username atau Password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}