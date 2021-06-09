<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Vendor\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VendorController extends Controller
{
    public function __invoke(Request $request)
    {
        $input  = $request->all();
        $vendor = \Auth::user();
        $location = Location::updateOrCreate(
            ['id' => $vendor->location_id ],
            $input
        );

        $vendor->update([
            'location_id' => $location->id
            ]);

        return response([
            'status' => true,
            'message'=> 'Ticket successfully updated',
            'data' => $location
        ], Response::HTTP_CREATED);
    }
}
