<?php

namespace App\Models\Rider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Rider extends Model
{
    use HasFactory, HasApiTokens, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function riderDetail()
    {
        return $this->hasOne('App\Models\Rider\Rider_detail','rider_id', 'id');
    }

    public function acceptPackage()
    {
        return $this->hasOne('App\Models\Rider\Accepted_package','rider_id', 'id');
    }


}
