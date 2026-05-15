<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModelPelanggan;
use App\Models\ModelPenjualan;

class ControllerPelangganAdmin extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST PELANGGAN + SEARCH
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $search = $request->search;

        $data = ModelPelanggan::query()

            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('nohp', 'like', '%' . $search . '%');
            })

            ->orderBy('id', 'desc')
            ->paginate(10);

        $data->appends(['search' => $search]);

        return view('admin.pelanggan.index', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PELANGGAN + TOTAL TRANSAKSI
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $pelanggan = ModelPelanggan::findOrFail($id);

        // total transaksi (semua status)
        $totalTransaksi = ModelPenjualan::where('pelangganid', $pelanggan->id)->count();

        // total belanja (hanya transaksi lunas)
        $totalBelanja = ModelPenjualan::where('pelangganid', $pelanggan->id)
            ->where('statuspembayaran', 'lunas')
            ->sum('total');

        return view('admin.pelanggan.show', compact(
            'pelanggan',
            'totalTransaksi',
            'totalBelanja'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | BLOKIR PELANGGAN (PERMANEN)
    |--------------------------------------------------------------------------
    */
    public function blokir($id)
    {
        $pelanggan = ModelPelanggan::findOrFail($id);

        // jika sudah blocked
        if ($pelanggan->status == 'blocked') {
            return back()->with('error', 'Pelanggan ini sudah diblokir.');
        }

        $pelanggan->update([
            'status' => 'blocked'
        ]);

        return back()->with('success', 'Pelanggan berhasil diblokir permanen.');
    }

    /*
    |--------------------------------------------------------------------------
    | AKTIFKAN KEMBALI PELANGGAN
    |--------------------------------------------------------------------------
    */
    public function aktifkan($id)
    {
        $pelanggan = ModelPelanggan::findOrFail($id);

        if ($pelanggan->status == 'aktif') {
            return back()->with('error', 'Pelanggan ini sudah aktif.');
        }

        $pelanggan->update([
            'status' => 'aktif'
        ]);

        return back()->with('success', 'Pelanggan berhasil diaktifkan kembali.');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS PELANGGAN (OPSIONAL)
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $pelanggan = ModelPelanggan::findOrFail($id);

        // optional: jika pelanggan punya transaksi, jangan hapus
        $cekTransaksi = ModelPenjualan::where('pelangganid', $pelanggan->id)->exists();

        if ($cekTransaksi) {
            return back()->with('error', 'Pelanggan tidak bisa dihapus karena memiliki transaksi.');
        }

        $pelanggan->delete();

        return redirect()
            ->route('admin.pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus.');
    }
}