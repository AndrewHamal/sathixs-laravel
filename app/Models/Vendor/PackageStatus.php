<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageStatus extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['package', 'acceptedPackage'];

    public function package()
    {
        return $this->belongsTo('App\Models\Vendor\Package', 'package_id', 'id');
    }

    public function acceptedPackage()
    {
        return $this->belongsTo('App\Models\Rider\Accepted_package', 'package_id', 'package_id');
    }
}
