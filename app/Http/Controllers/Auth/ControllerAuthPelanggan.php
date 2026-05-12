<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\ModelPelanggan;

class ControllerAuthPelanggan extends Controller
{
    public function login()
    {
        return view('auth.loginpelanggan');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $login = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::guard('pelanggan')->attempt($login)) {

            $request->session()->regenerate();

            return redirect()->route('pelanggan.dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function register()
    {
        return view('auth.registerpelanggan');
    }

    public function registerProses(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:pelanggan,username',
            'email'    => 'required|email|unique:pelanggan,email',
            'nohp'     => 'required|string|max:20',
            'password' => 'required|min:6'
        ]);

        ModelPelanggan::create([
            'name'        => $request->name,
            'username'    => $request->username,
            'email'       => $request->email,
            'nohp'        => $request->nohp,
            'password'    => Hash::make($request->password),
            'foto'        => null,
            'point'       => 0,
            'levelmember' => 'silver',
            'status'      => 'aktif',
        ]);

        return redirect()
            ->route('pelanggan.login')
            ->with('success', 'Register berhasil, silahkan login.');
    }

    public function logout(Request $request)
    {
        Auth::guard('pelanggan')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('pelanggan.login');
    }
}
