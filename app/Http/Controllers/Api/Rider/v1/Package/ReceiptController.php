<?php

namespace App\Http\Controllers\Api\Rider\v1\Package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Package_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReceiptController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'package_id' => ['required'],
            'receiver_signature_name' => ['required','string'],
            'receiver_signature_image' => ['required','image','mimes:jpeg,png,jpg,heic','max:2048']
        ]);
        $path = Storage::disk('public')->put('rider/images', $request->receiver_signature_image);

        Package::where('id', $request->package_id)->update([
            'receiver_signature_image' => $path,
            'receiver_signature_name' => $request->receiver_signature_name
        ]);

        Package_status::where('package_id', $request->package_id)->update(['process_step'=>3]);

        return response([
            'status_code'=> 200,
            'message'=> 'Receipt Upload successfully!',
            'data' => [
                'path'=>$path,
                'package_id'=> $request->package_id,
                'receiver_signature_name'=> $request->receiver_signature_name
            ]
        ]);
    }
}
