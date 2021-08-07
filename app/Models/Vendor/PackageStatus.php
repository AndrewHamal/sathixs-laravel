<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageStatus extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['package', 'acceptedPackage', 'cancelRide'];
    protected $appends = ['chat_last', 'new_chat'];

    public function package()
    {
        return $this->belongsTo('App\Models\Vendor\Package', 'package_id', 'id');
    }

    public function acceptedPackage()
    {
        return $this->belongsTo('App\Models\Rider\Accepted_package', 'package_id', 'package_id');
    }

    public function cancelRide()
    {
        return $this->belongsTo('App\Models\Rider\CancelRide', 'package_id', 'package_id');
    }

    public function getChatLastAttribute()
    {
        return RiderVendorChat::where('package_id', $this->package->id)
        ->orderBy('id', 'DESC')
        ->first();
    }

    public function getNewChatAttribute()
    {
        return RiderVendorChat::where('package_id', $this->package->id)
        ->where('status', 1)
        ->exists();
    }
}
