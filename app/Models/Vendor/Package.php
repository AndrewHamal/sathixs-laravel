<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['category','vendor','package_file'];


    public function acceptPackage()
    {
        return $this->hasOne('App\Models\Accepted_package','package_id', 'id');
    }

    public function packageStatus()
    {
        return $this->hasOne('App\Models\Package_status','package_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor\Vendor','vendor_id','id');
    }

    public function package_file()
    {
        return $this->hasmany('App\Models\Vendor\PackageFile','package_id','id');
    }

    public function uploadFiles($files): array
    {
        $uploaded = [];
        if (! $files) {
            return [];
        }

        foreach ($files as $file) {
            array_push($uploaded, ['path' => Storage::disk('public')->put('vendor/package', $file)]);
        }

        return $uploaded;
    }
}
