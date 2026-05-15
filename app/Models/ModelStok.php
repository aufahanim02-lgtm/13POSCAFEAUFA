<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelStok extends Model
{
    use HasFactory;

    protected $table = 'stok';

    protected $fillable = [
        'bahanbakuid',
        'stoktersedia',
        'stokminimal',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function bahanbaku()
    {
        return $this->belongsTo(ModelBahanBaku::class, 'bahanbakuid', 'id');
    }
    public function setSelesai($id)
    {
        $pesanan = ModelPenjualan::with('detail')->findOrFail($id);

        // CEGAH DOUBLE KURANGI STOK
        if ($pesanan->statuspesanan == 'selesai') {
            return back()->with('error', 'Pesanan ini sudah selesai sebelumnya.');
        }

        foreach ($pesanan->detail as $item) {

            // KURANGI STOK DI TABEL PRODUK
            $produk = ModelProduk::find($item->produkid);

            if ($produk) {
                $produk->stok = $produk->stok - $item->qty;
                if ($produk->stok < 0) {
                    $produk->stok = 0;
                }
                $produk->save();
            }

            // KURANGI STOK DI TABEL STOK (INVENTORY)
            $stok = ModelStok::where('produkid', $item->produkid)->first();

            if ($stok) {
                $stok->jumlah = $stok->jumlah - $item->qty;
                if ($stok->jumlah < 0) {
                    $stok->jumlah = 0;
                }
                $stok->save();
            }
        }

        $pesanan->update([
            'statuspesanan' => 'selesai'
        ]);

        return back()->with('success', 'Pesanan selesai & stok otomatis berkurang.');
    }
}
