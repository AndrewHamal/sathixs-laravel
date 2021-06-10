<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageStatus extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['package'];

    public function package()
    {
        return $this->belongsTo('App\Models\Package','package_id','id');
    }
}
