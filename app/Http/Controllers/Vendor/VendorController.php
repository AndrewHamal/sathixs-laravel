<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Vendor\Ticket;
use App\Models\Vendor\Vendor;
use App\Models\Vendor\VendorDetail;
use App\Models\Vendor\VendorFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    public function locationUpdate(Request $request)
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
            'message'=> 'Location successfully updated',
            'data' => $location
        ], Response::HTTP_CREATED);
    }

    public function profileUpdate(Request $request)
    {
        $vendor = Vendor::find(Auth::user()->id);
        $vendor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return response([
            'message' => 'Vendor Profile Updated Successfully',
            'data' => $vendor
        ]);
    }

    public function updatePan(Request $request)
    {
        $vendor = VendorDetail::where('vendor_id', Auth::user()->id)->first();
        $request->validate([
            'file' => 'required',
            'file.*' => 'image|mimes:jpeg,png,jpg,pdf,svg|max:2048'
        ]);

        $file = $request->file('file');
        $fileData = [];

        if(@count($vendor->pan ?? [])){
            $fileData = $vendor->pan;
        }

        $path = Storage::disk('public')->put('vendor/images', $file);
        array_push($fileData, $path);

        $vendor = VendorDetail::updateOrCreate([
            'vendor_id' => Auth::user()->id
        ],
        [
            'pan' => $fileData
        ]
        );

        return response([
            'message'=> 'Document Uploaded',
            'status' => 'done'
        ]);

    }

    public function updateId(Request $request)
    {
        $vendor = VendorDetail::where('vendor_id', Auth::user()->id)->first();
        $request->validate([
            'file' => 'required',
            'file.*' => 'image|mimes:jpeg,png,jpg,pdf,svg|max:2048'
        ]);

        $file = $request->file('file');
        $fileData = [];

        if(@count($vendor->id_proof ?? [])){
            $fileData = $vendor->id_proof;
        }

        $path = Storage::disk('public')->put('vendor/images', $file);
        array_push($fileData, $path);

        $vendor = VendorDetail::updateOrCreate([
            'vendor_id' => Auth::user()->id
        ],
        [
            'id_proof' => $fileData
        ]
        );

        return response([
            'message'=> 'Document Uploaded',
            'status' => 'done'
        ]);
    }

    public function updateTax(Request $request)
    {
        $vendor = VendorDetail::where('vendor_id', Auth::user()->id)->first();
        $request->validate([
            'file' => 'required',
            'file.*' => 'image|mimes:jpeg,png,jpg,pdf,svg|max:2048'
        ]);

        $file = $request->file('file');
        $fileData = [];

        if(@count($vendor->tax ?? [])){
            $fileData = $vendor->tax;
        }

        $path = Storage::disk('public')->put('vendor/images', $file);
        array_push($fileData, $path);

        $vendor = VendorDetail::updateOrCreate([
            'vendor_id' => Auth::user()->id
        ],
        [
            'tax' => $fileData
        ]
        );

        return response([
            'message'=> 'Document Uploaded',
            'status' => 'done'
        ]);
    }

    public function destroyPan($arrayKey)
    {
        $files = VendorDetail::select('pan')->where('vendor_id', auth()->user()->id)->first();
        $arr = $files->pan;
        if(array_key_exists($arrayKey, $arr)){
            Storage::disk('public')->delete($arr[$arrayKey]);
            unset($arr[$arrayKey]);
            $file_arr = array_values($arr);
            VendorDetail::where('vendor_id', auth()->user()->id)->update(['pan'=>$file_arr]);

            return response([
                'message' => 'Document Deleted!',
                'data' => $file_arr
            ]);
        }else{
            return response([
                'error' => 'File not found'
            ]);
        }
    }

    public function destroyId($arrayKey)
    {
        $files = VendorDetail::select('id_proof')->where('vendor_id', auth()->user()->id)->first();
        $arr = $files->id_proof;
        if(array_key_exists($arrayKey, $arr)){
            Storage::disk('public')->delete($arr[$arrayKey]);
            unset($arr[$arrayKey]);
            $file_arr = array_values($arr);
            VendorDetail::where('vendor_id', auth()->user()->id)->update(['id_proof'=>$file_arr]);

            return response([
                'message' => 'Document Deleted!',
                'data' => $file_arr
            ]);
        }else{
            return response([
                'error' => 'File not found'
            ]);
        }
    }

    public function destroyTax($arrayKey)
    {
        $files = VendorDetail::select('tax')->where('vendor_id', auth()->user()->id)->first();
        $arr = $files->tax;
        if(array_key_exists($arrayKey, $arr)){
            Storage::disk('public')->delete($arr[$arrayKey]);
            unset($arr[$arrayKey]);
            $file_arr = array_values($arr);
            VendorDetail::where('vendor_id', auth()->user()->id)->update(['tax'=>$file_arr]);

            return response([
                'message' => 'Document Deleted!',
                'data' => $file_arr
            ]);
        }else{
            return response([
                'error' => 'File not found'
            ]);
        }
    }


}
