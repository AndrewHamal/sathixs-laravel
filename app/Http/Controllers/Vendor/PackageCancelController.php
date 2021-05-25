<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor\PackageCancelReason;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PackageCancelController extends Controller
{
    public function __invoke(Request $request)
    {
        $input = $request->all();
        $packageCancel = PackageCancelReason::create( $input );

        return response([
            'status' => true,
            'message' => 'Package Canceled Successfully',
            'data' => $packageCancel,
        ], Response::HTTP_CREATED);
    }
}
