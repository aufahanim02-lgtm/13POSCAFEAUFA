<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelResep extends Model
{
    protected $table = 'resep';

    protected $fillable = [
        'produkid',
        'bahanbakuid',
        'jumlah',
        'satuan'
    ];

    public function produk()
    {
        return $this->belongsTo(ModelProduk::class, 'produkid');
    }

    public function bahanbaku()
    {
        return $this->belongsTo(ModelBahanBaku::class, 'bahanbakuid');
    }
}
