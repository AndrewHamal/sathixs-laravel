<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDetail extends Model
{
    use HasFactory;

    protected $casts = [
        'pan'=> 'array',
        'id_proof'=> 'array',
        'tax'=> 'array'
    ];

    protected $guarded = [];
}
