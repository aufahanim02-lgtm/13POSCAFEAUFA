<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelKeranjang;
use App\Models\ModelProduk;

class ControllerKeranjang extends Controller
{
    public function index()
    {
        $pelangganId = Auth::guard('pelanggan')->id();

        $keranjang = ModelKeranjang::with('produk')
            ->where('pelangganid', $pelangganId)
            ->orderBy('id', 'desc')
            ->get();

        return view('pelanggan.keranjang.index', compact('keranjang'));
    }

    public function tambah($produkid)
    {
        $pelangganId = Auth::guard('pelanggan')->id();

        $produk = ModelProduk::findOrFail($produkid);

        $cek = ModelKeranjang::where('pelangganid', $pelangganId)
            ->where('produkid', $produkid)
            ->first();

        if ($cek) {
            $cek->qty = $cek->qty + 1;
            $cek->subtotal = $cek->qty * $cek->harga;
            $cek->save();
        } else {
            ModelKeranjang::create([
                'pelangganid' => $pelangganId,
                'produkid' => $produkid,
                'qty' => 1,
                'harga' => $produk->hargajual,
                'subtotal' => $produk->hargajual
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function hapus($id)
    {
        $pelangganId = Auth::guard('pelanggan')->id();

        $data = ModelKeranjang::where('id', $id)
            ->where('pelangganid', $pelangganId)
            ->firstOrFail();

        $data->delete();

        return redirect()->back()->with('success', 'Item keranjang berhasil dihapus.');
    }

    public function checkout()
    {
        $pelangganId = Auth::guard('pelanggan')->id();

        $keranjang = ModelKeranjang::with('produk')
            ->where('pelangganid', $pelangganId)
            ->orderBy('id', 'desc')
            ->get();

        if ($keranjang->count() == 0) {
            return redirect()->route('pelanggan.keranjang.index')->with('error', 'Keranjang masih kosong.');
        }

        return view('pelanggan.keranjang.checkout', compact('keranjang'));
    }
}