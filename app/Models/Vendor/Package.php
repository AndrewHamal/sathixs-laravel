<?php

namespace App\Models\Vendor;

use App\Models\Location;
use App\Models\Rider\Rider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['category', 'vendor', 'package_file', 'Location'];
    protected $appends = ['process_step', 'rider', 'chat_last', 'new_chat'];

    public function acceptPackage()
    {
        return $this->hasOne('App\Models\Accepted_package','package_id', 'id');
    }

    public function packageStatus()
    {
        return $this->belongsTo('App\Models\Vendor\PackageStatus', 'id', 'package_id');
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

    public function getProcessStepAttribute()
    {
        return PackageStatus::where('package_id', $this->id)->first()->process_step ?? null;
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

    public function Location()
    {
        return $this->belongsTo('App\Models\Location', 'receiver_address', 'id');
    }

    public function getRiderAttribute()
    {
        $riderId = @PackageStatus::where('package_id', $this->id)->first()->rider_id;
        return @Rider::find($riderId) ?? '';
    }

    public function getChatLastAttribute()
    {
        return RiderVendorChat::where('package_id', $this->id)
        ->orderBy('id', 'DESC')
        ->first();
    }

    public function getNewChatAttribute()
    {
        return RiderVendorChat::where('package_id', $this->id)
        ->where('status', 1)
        ->exists();
    }
}
