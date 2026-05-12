<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ControllerProfilPelanggan extends Controller
{
    public function index()
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        return view('pelanggan.profil.index', compact('pelanggan'));
    }

    public function edit()
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        return view('pelanggan.profil.edit', compact('pelanggan'));
    }

    public function update(Request $request)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        if (!$pelanggan) {
            return redirect()->route('pelanggan.login')->with('error', 'Silahkan login terlebih dahulu.');
        }

        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:pelanggan,username,' . $pelanggan->id,
            'email'    => 'required|email|max:100|unique:pelanggan,email,' . $pelanggan->id,
            'nohp'     => 'required|string|max:20',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|min:5'
        ]);

        $pelanggan->name = $request->name;
        $pelanggan->username = $request->username;
        $pelanggan->email = $request->email;
        $pelanggan->nohp = $request->nohp;

        // UPLOAD FOTO
        if ($request->hasFile('foto')) {

            if ($pelanggan->foto && Storage::disk('public')->exists('pelanggan/' . $pelanggan->foto)) {
                Storage::disk('public')->delete('pelanggan/' . $pelanggan->foto);
            }

            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('pelanggan', $namaFile, 'public');

            $pelanggan->foto = $namaFile;
        }

        // UPDATE PASSWORD (JIKA DIISI)
        if ($request->filled('password')) {
            $pelanggan->password = Hash::make($request->password);
        }

        $pelanggan->save();

        return redirect()->route('pelanggan.profil.index')->with('success', 'Profil berhasil diperbarui.');
    }
}