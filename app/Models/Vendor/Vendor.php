<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Location;

class Vendor extends Model
{
    use HasApiTokens, HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['location'];

    public function getLocationAttribute()
    {
        return Location::find($this->location_id);
    }

    public function package()
    {
        return $this->hasMany('App\Models\Package','vendor_id','id');
    }

}
