<?php

namespace App\Http\Controllers\Api\Rider\v1\Package;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rider\v1\CancelReasonRequest;
use App\Models\Accepted_package;
use App\Models\Cancel_reason;
use App\Models\Package_status;
use Illuminate\Http\Request;

class ManagePackage extends Controller
{
    public function acceptPackage($package_id)
    {
        $accept_package = Accepted_package::create([
            'rider_id' => auth()->user()->id,
            'package_id' => $package_id
        ]);

        Package_status::create([
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
        return Package_status::where([['rider_id',auth()->user()->id],['process_step','!=',3]])->get();
    }

    public function historyPackage()
    {
        return Package_status::where([['rider_id',auth()->user()->id],['process_step',3]])->get();
    }

    public function show_package($id)
    {
        return Package_status::where([['rider_id',auth()->user()->id],['package_id',$id]])->get();
    }

    public function cancel_reason()
    {
        return Cancel_reason::all();
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
