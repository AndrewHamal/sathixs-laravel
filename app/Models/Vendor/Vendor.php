<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Location;

class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $guarded = ['id','vendor'];

    protected $appends = ['location'];

    public function getLocationAttribute()
    {
        return Location::find($this->location_id);
    }

    public function package()
    {
        return $this->hasMany('App\Models\Vendor\Package','vendor_id','id');
    }

    public function ticket()
    {
        return $this->hasMany('App\Models\Vendor\Ticket', 'vendor_id', 'id');
    }

}
