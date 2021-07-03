<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorFile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor\Vendor','vendor_id', 'id');
    }
}
