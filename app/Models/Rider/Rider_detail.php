<?php

namespace App\Models\Rider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider_detail extends Model
{
    use HasFactory;

    protected $casts = [
        'driving_license'=> 'array',
        'photo_id_proof'=> 'array',
        'registration_certificate'=> 'array',
        'vehicle_insurance'=> 'array'
    ];
    protected $guarded = [];
    protected $appends = ['work_location','home_location'];

    public function getWorkLocationAttribute()
    {
        return Location::find($this->work_location_id);
    }

    public function getHomeLocationAttribute()
    {
        return Location::find($this->home_location_id);
    }



}
