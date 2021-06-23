<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageFile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function package()
    {
        return $this->belongsTo('App\Models\Vendor\Package','package_id','id');
    }
}
