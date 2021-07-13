<?php

namespace App\Http\Controllers\Api\Rider\v1\Package;

use App\Events\RiderPackage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rider\v1\CancelReasonRequest;
use App\Models\Rider\Accepted_package;
use App\Models\CancelReason;
use App\Models\Rider\CancelRide;
use App\Models\Vendor\Package;
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
            'message' => 'Sorry, Package already accepted',
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
        return CancelRide::where('rider_id', auth()->user()->id)
        ->paginate(10);

    }

    public function show_package($id)
    {
        return PackageStatus::where([['rider_id',auth()->user()->id],['package_id',$id]])
        
        ->first();
    }

    public function cancel_reason()
    {
        return CancelReason::all();
    }

    public function add_cancel_reason(CancelReasonRequest $request)
    {
        try{
            $data = CancelRide::create([
                'rider_id' => auth()->user()->id,
                'package_id' => $request->package_id,
                'cancel_reasons_id' =>  $request->cancel_reasons_id != 5 ? $request->cancel_reasons_id : null,
                'custom_cancel_reason' => $request->cancel_reasons_id == 5 ? $request->custom_cancel_reason : null
            ]);

            Accepted_package::where('package_id', $request->package_id)->delete();

            // after store send notification to all the rider
            broadcast(new RiderPackage([Package::find($request->package_id), 'rider_id' => auth()->user()->id]));

            return response([
                'message'=> 'Package cancel reason added',
                'data' => $data
            ]);
        }catch(\Exception $e){
            return response([
                'message' => 'Something went wrong, please try again!',
                'data' => $e
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
