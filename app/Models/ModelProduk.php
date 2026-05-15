<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelProduk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'kategoriid',
        'kodeproduk',
        'namaproduk',
        'deskripsi',
        'hargajual',
        'stok',
        'stokproduk',
        'satuan',
        'foto',
        'status'
    ];

    public function kategori()
    {
        return $this->belongsTo(
            ModelKategori::class,
            'kategoriid',
            'id'
        );
    }

    public function resep()
    {
        return $this->hasMany(
            ModelResep::class,
            'produkid'
        );
    }

    public function wishlist()
    {
        return $this->hasMany(ModelWishlist::class, 'produkid');
    }
}
