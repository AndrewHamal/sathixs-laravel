<?php

namespace App\Http\Controllers\Vendor_web\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor_web\Profile\ProfileRequest;
use App\Models\Location;
use App\Models\Vendor\Vendor;
use App\Models\Vendor\VendorFile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:vendor');
    }

    public function show()
    {
        $vendor = Vendor::where('id', auth()->user()->id)->first();
        return view('vendor_web.profile.show', compact('vendor'));
    }

    public function update(ProfileRequest $request, $id)
    {
        $vendor = Vendor::findOrfail($id);
        if($vendor->location_id != null)
        {
            Location::findOrFail($vendor->location_id)->update([
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'lat' => $request->lat,
                'long' => $request->long,
                'whole_address' => $request->whole_address,
            ]);
        }else{
            $newLocation = Location::create([
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'lat' => $request->lat,
                'long' => $request->long,
                'whole_address' => $request->whole_address,
            ]);

            Vendor::findOrfail($id)->update(['location_id' => $newLocation->id]);
        }

        Vendor::findOrfail($id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if($request->hasFile('profile_pic')) {
            $path = Storage::disk('public')->put('vendor/images', $request->profile_pic);
            Vendor::findOrfail($id)->update(['profile_picture' => $path]);
        }

        if( $request->hasFile('image')) {
            // delete previous file
            if(!empty($request->arr_ids)) {
                foreach($request->arr_ids as $row) {
                    VendorFile::destroy($row);
                }
            }

            // then add new files
            $vendorInstance = new Vendor();
            $files = $vendorInstance->uploadFiles($request->image);

            foreach ($files as $file)
            {
                $file['vendor_id'] =  auth()->user()->id;
                VendorFile::create($file);
            }
        }

        $notification=array(
            'message'=>'Vendor updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

}
