<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;

class ControllerLanding extends Controller
{
    public function home()
    {
        return view('landing.home');
    }

    public function menu()
    {
        return view('landing.menu');
    }

    public function promo()
    {
        return view('landing.promo');
    }

    public function tentang()
    {
        return view('landing.tentang');
    }

    public function kontak()
    {
        return view('landing.kontak');
    }
}