<?php

namespace App\Models\Rider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelRide extends Model
{
    use HasFactory;

    protected $with = ['package'];

    protected $guarded = [''];

    public function package()
    {
        return $this->belongsTo('App\Models\Vendor\Package', 'package_id', 'id');
    }
}
