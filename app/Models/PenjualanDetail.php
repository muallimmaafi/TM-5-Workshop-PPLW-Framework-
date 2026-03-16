<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    protected $table = 'penjualan_detail';

    protected $primaryKey = 'idpenjualan_detail';

    protected $fillable = [
        'id_penjualan',
        'id_barang',
        'jumlah',
        'subtotal'
    ];

    public $timestamps = false;
}