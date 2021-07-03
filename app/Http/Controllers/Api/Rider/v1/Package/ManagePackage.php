<?php

namespace App\Http\Controllers\Api\Rider\v1\Package;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rider\v1\CancelReasonRequest;
use App\Models\Rider\Accepted_package;
use App\Models\CancelReason;
use App\Models\Vendor\PackageStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ManagePackage extends Controller
{
    public function acceptPackage($package_id)
    {
        if( !Accepted_package::where('package_id', $package_id)->exists() ){
            $accept_package = Accepted_package::create([
                'rider_id' => auth()->user()->id,
                'package_id' => $package_id
            ]);
            PackageStatus::create([
                'process_step'=> 0,
                'rider_id'=> auth()->user()->id,
                'package_id'=> $package_id,
                'status' => 1
            ]);

            return response([
                'message' => 'Package Accepted!',
                'data' => $accept_package
            ]);

        }

        return response([
            'message' => 'Package already accepted!!!',
        ], Response::HTTP_EXPECTATION_FAILED);

    }

    public function ongoingPackage()
    {
        return PackageStatus::where([['rider_id',auth()->user()->id],['process_step','!=',3]])
        ->whereHas('acceptedPackage', fn($row)=> $row->where([['custom_cancel_reason', null], ['cancel_reasons_id', null]]))
        ->paginate(10);
    }

    public function historyPackage()
    {
        return PackageStatus::where([['rider_id',auth()->user()->id],['process_step',3]])->paginate(10);
    }

    public function canceledPackage()
    {
        return PackageStatus::where('rider_id', auth()->user()->id)
        ->whereHas('acceptedPackage', fn($row) => $row->where('custom_cancel_reason', '!=', null)->OrWhere('cancel_reasons_id', '!=', null))
        ->paginate(10);
    }

    public function show_package($id)
    {
        return PackageStatus::where([['rider_id',auth()->user()->id],['package_id',$id]])->first();
    }

    public function cancel_reason()
    {
        return CancelReason::all();
    }

    public function add_cancel_reason(CancelReasonRequest $request)
    {
        $data = Accepted_package::where([['rider_id',auth()->user()->id],['package_id',$request->package_id]])->update([
            'cancel_reasons_id' =>  $request->cancel_reasons_id != 5 ? $request->cancel_reasons_id : null,
            'custom_cancel_reason' => $request->cancel_reasons_id == 5 ? $request->custom_cancel_reason : null
        ]);

        return response([
            'message'=> 'Package cancel reason added',
            'data' => $data
        ]);
    }

}
