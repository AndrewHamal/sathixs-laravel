<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Location;

class Vendor extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $guarded = ['id','vendor'];

    protected $appends = ['location', 'pan', 'tax', 'id_proof'];

    protected $hidden = ['password'];

    protected $with =['vendor_file'];

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

    public function vendor_file()
    {
        return $this->hasMany('App\Models\Vendor\VendorFile', 'vendor_id', 'id');
    }

    public function uploadFiles($files): array
    {
        $uploaded = [];
        if (! $files) {
            return [];
        }

        foreach ($files as $file) {
            array_push($uploaded, ['path' => Storage::disk('public')->put('vendor/document', $file)]);
        }

        return $uploaded;
    }

    public function getPanAttribute()
    {
        $image = [];
        $vendor = VendorDetail::find($this->id)->pan ?? [];
        if(count($vendor) > 0) {
            foreach($vendor as $key=>$r){
                $image[$key] = [
                    'uid' => $key,
                    'name' => env('APP_URL'). Storage::url($r),
                    'thumbUrl' => env('APP_URL'). Storage::url($r),
                ];
            }
            return $image;
        }
    }

    public function getIdProofAttribute()
    {
        $image = [];
        $vendor = VendorDetail::find($this->id)->id_proof ?? [];
        if(count($vendor) > 0) {
            foreach($vendor as $key=>$r){
                $image[$key] = [
                    'uid' => $key,
                    'name' => env('APP_URL'). Storage::url($r),
                    'thumbUrl' => env('APP_URL'). Storage::url($r),
                ];
            }
            return $image;
        }
    }

    public function getTaxAttribute()
    {
        $image = [];
        $vendor = VendorDetail::find($this->id)->tax ?? [];
        if(count($vendor) > 0) {
            foreach($vendor as $key=>$r){
                $image[$key] = [
                    'uid' => $key,
                    'name' => env('APP_URL'). Storage::url($r),
                    'thumbUrl' => env('APP_URL'). Storage::url($r),
                ];
            }
            return $image;
        }
    }

}
