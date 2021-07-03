<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\DataTables\VendorDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Vendor\UpdateVendorRequest;
use App\Http\Requests\Admin\Vendor\VendorRequest;
use App\Models\Location;
use App\Models\Vendor\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VendorDataTable $dataTable)
    {
        return $dataTable->render('admin_web.vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_web.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {
        $location = Location::create([
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'long' => $request->long,
            'lat' => $request->lat,
            'whole_address' => $request->whole_address
        ]);
        $path = '';
        if($request->hasFile('profile_picture'))
        {
            $path = Storage::disk('public')->put('vendor/images', $request->profile_picture);
        }

        Vendor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'location_id' => $location->id,
            'profile_picture' => $path
        ]);

        $notification=array(
            'message'=>'Vendor Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin_vendor.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendor = Vendor::with('package')->find($id);
        return view('admin_web.vendor.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::find($id);
        return view('admin_web.vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorRequest $request, $id)
    {
        Location::where('id', $request->location_id)->update([
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'long' => $request->long,
            'lat' => $request->lat,
            'whole_address' => $request->whole_address
        ]);

        if($request->hasFile('profile_picture'))
        {
            $path = Storage::disk('public')->put('vendor/images', $request->profile_picture);
            Vendor::where('id', $id)->update(['profile_picture' => $path]);
        }

        Vendor::where('id',$id)->update([
            'first_name'=> $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $notification=array(
            'message'=>'Vendor Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin_vendor.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vendor::destroy($id);
        return response()->json(['message'=>'Vendor Deleted Successfully', 'type'=> 'success']);

    }
}
