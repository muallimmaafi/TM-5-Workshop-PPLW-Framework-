<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor;

class Menu extends Model
{
    protected $fillable = [
        'vendor_id',
        'name',
        'price'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}