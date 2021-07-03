<?php

namespace App\Http\Controllers\Api\Rider;

use App\Http\Controllers\Controller;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __invoke()
    {
        return Vendor::
        where('location_id', '!=', null)
        ->select('first_name', 'last_name', 'location_id')
        ->get();
    }
}
