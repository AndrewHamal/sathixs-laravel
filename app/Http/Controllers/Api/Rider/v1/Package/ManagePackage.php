<?php

namespace App\Http\Controllers\Api\Rider\v1\Package;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rider\v1\CancelReasonRequest;
use App\Models\Rider\Accepted_package;
use App\Models\CancelReason;
use App\Models\Vendor\PackageStatus;
use Illuminate\Http\Request;

class ManagePackage extends Controller
{
    public function acceptPackage($package_id)
    {
        $accept_package = Accepted_package::create([
            'rider_id' => auth()->user()->id,
            'package_id' => $package_id
        ]);

        PackageStatus::create([
            'process_step'=>1,
            'rider_id'=> auth()->user()->id,
            'package_id'=> $package_id,
            'status' => 1
        ]);

        return response([
            'message' => 'Package Accepted!',
            'data' => $accept_package
        ]);
    }

    public function ongoingPackage()
    {
        return PackageStatus::where([['rider_id',auth()->user()->id],['process_step','!=',3]])->get();
    }

    public function historyPackage()
    {
        return PackageStatus::where([['rider_id',auth()->user()->id],['process_step',3]])->get();
    }

    public function show_package($id)
    {
        return PackageStatus::where([['rider_id',auth()->user()->id],['package_id',$id]])->get();
    }

    public function cancel_reason()
    {
        return CancelReason::all();
    }

    public function add_cancel_reason(CancelReasonRequest $request)
    {
        Accepted_package::where([['rider_id',auth()->user()->id],['package_id',$request->package_id]])->update([
            'cancel_reasons_id' => $request->cancel_reasons_id,
            'custom_cancel_reason' => $request->custom_cancel_reason
        ]);

        return response([
            'message'=> 'Package cancel reason added'
        ]);
    }

}
