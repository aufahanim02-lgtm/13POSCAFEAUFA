<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ModelLoginHistory;
use Carbon\Carbon;

class ControllerAuthUser extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM LOGIN
    |--------------------------------------------------------------------------
    */
    public function login()
    {
        return view('auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES LOGIN
    |--------------------------------------------------------------------------
    */
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

        /*
        |--------------------------------------------------------------------------
        | LOGIN BERHASIL
        |--------------------------------------------------------------------------
        */
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            /*
            |--------------------------------------------------------------------------
            | SIMPAN LOGIN HISTORY
            |--------------------------------------------------------------------------
            */
            ModelLoginHistory::create([

                'userid'    => Auth::user()->id,

                'ipaddress' => $request->ip(),

                'useragent' => $request->userAgent(),

                'loginat'   => Carbon::now(),

                'logoutat'  => null,

                'status'    => 'success'
            ]);

            /*
            |--------------------------------------------------------------------------
            | REDIRECT BERDASARKAN ROLE
            |--------------------------------------------------------------------------
            */
            $role = Auth::user()->role;

            if ($role == 'owner') {

                return redirect('/dashboardowner')
                    ->with(
                        'success',
                        'Login berhasil sebagai Owner'
                    );
            }

            if ($role == 'manager') {

                return redirect('/dashboardmanager')
                    ->with(
                        'success',
                        'Login berhasil sebagai Manager'
                    );
            }

            if ($role == 'kasir') {

                return redirect('/dashboardkasir')
                    ->with(
                        'success',
                        'Login berhasil sebagai Kasir'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | ROLE TIDAK VALID
            |--------------------------------------------------------------------------
            */
            Auth::logout();

            return redirect('/login')
                ->with(
                    'error',
                    'Role tidak valid!'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | LOGIN GAGAL
        |--------------------------------------------------------------------------
        */
        return redirect('/login')
            ->with(
                'error',
                'Username atau Password salah!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | UPDATE LOGOUT HISTORY
        |--------------------------------------------------------------------------
        */
        if ($user) {

            $history = ModelLoginHistory::where(
                'userid',
                $user->id
            )
            ->whereNull('logoutat')
            ->latest()
            ->first();

            if ($history) {

                $history->update([

                    'logoutat' => Carbon::now()

                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | LOGOUT USER
        |--------------------------------------------------------------------------
        */
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')
            ->with(
                'success',
                'Logout berhasil!'
            );
    }
}