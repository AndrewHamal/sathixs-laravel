<?php

namespace App\Models\Rider;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class Rider extends Authenticatable
{
    use HasFactory, HasApiTokens, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    protected $hidden = ['password'];
    protected $appends = ['driver_license', 'id_proof', 'insurance'];

    public function riderDetail()
    {
        return $this->hasOne('App\Models\Rider\Rider_detail','rider_id', 'id');
    }

    public function acceptPackage()
    {
        return $this->hasOne('App\Models\Rider\Accepted_package','rider_id', 'id');
    }

    public function getDriverLicenseAttribute()
    {
        $image = [];
        $rider = Rider_detail::find($this->id)->driving_license ?? [];

        if(count($rider) > 0) {
            foreach($rider as $key=>$r){
                $image[$key] = [
                    'uid' => $key,
                    'name' => env('APP_URL'). Storage::url($r),
                ];
            }
            return $image;
        }
    }

    public function getIdProofAttribute()
    {
        $image = [];
        $rider = Rider_detail::find($this->id)->photo_id_proof ?? [];
        if(count($rider) > 0) {
            foreach($rider as $key=>$r){
                $image[$key] = [
                    'uid' => $key,
                    'name' => env('APP_URL'). Storage::url($r),
                ];
            }
            return $image;
        }
    }

    public function getInsuranceAttribute()
    {
        $image = [];
        $rider = Rider_detail::find($this->id)->vehicle_insurance ?? [];
        if(count($rider) > 0) {
            foreach($rider as $key=>$r){
                $image[$key] = [
                    'uid' => $key,
                    'name' => env('APP_URL'). Storage::url($r),
                ];
            }
            return $image;
        }
    }

}
