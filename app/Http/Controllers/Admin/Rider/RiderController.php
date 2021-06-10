<?php

namespace App\Http\Controllers\Admin\Rider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rider\Admin\RiderRequest;
use App\Http\Requests\Rider\Admin\RiderUpdateRequest;
use App\Models\Location;
use App\Models\Rider\Rider;
use App\Models\Rider\Rider_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiderController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riders = Rider::with('riderDetail')->paginate();
        return view('rider.index', compact('riders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RiderRequest $request)
    {
        $path = Storage::disk('public')->put('rider/images', $request->profile_photo);
        $rider = Rider::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'profile_photo' => $path

        ]);

        $home_location = Location::create([
            'city' => $request->home_city,
            'state' => $request->home_state,
            'country' => $request->home_country,
            'long' => $request->home_long,
            'lat' => $request->home_lat,
            'whole_address' => $request->home_whole_address,
        ]);

        $work_location = Location::create([
            'city' => $request->work_city,
            'state' => $request->work_state,
            'country' => $request->work_country,
            'long' => $request->work_long,
            'lat' => $request->work_lat,
            'whole_address' => $request->work_whole_address,
        ]);

        if($request->hasFile('driving_license'))
        {
            $driving_files = $request->file('driving_license');
            $driving_fileData = $this->multiple_document($driving_files);
        }
        if($request->hasFile('photo_id_proof'))
        {
            $proof_files = $request->file('photo_id_proof');
            $proof_fileData = $this->multiple_document($proof_files);
        }
        if($request->hasFile('vehicle_insurance'))
        {
            $insurance_files = $request->file('vehicle_insurance');
            $insurance_fileData = $this->multiple_document($insurance_files);
        }
        if($request->hasFile('registration_certificate'))
        {
            $registration_files = $request->file('registration_certificate');
            $registration_fileData = $this->multiple_document($registration_files);
        }

        Rider_detail::create([
            'rider_id'=> $rider->id,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'driving_license' => $driving_fileData,
            'photo_id_proof' => $proof_fileData,
            'vehicle_insurance' => $insurance_fileData,
            'registration_certificate' => $registration_fileData,
            'home_location_id' => $home_location->id,
            'work_location_id' => $work_location->id
        ]);

        $notification=array(
            'message'=>'Rider Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('rider.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rider = Rider::with('riderDetail')->where('id', $id)->first();
        return view('rider.show', compact('rider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rider = Rider::with('riderDetail')->where('id', $id)->first();
        return view('rider.edit', compact('rider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RiderUpdateRequest $request, $id)
    {
        if($request->hasFile('profile_photo')){
            $path = Storage::disk('public')->put('rider/images', $request->profile_photo);
            Rider::where('id',$id)->update(['profile_photo' => $path]);
        }

         Rider::where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone

        ]);

        $rider = Rider::with('riderDetail')->where('id', $id)->first();

        if(isset($rider->riderDetail->home_location))
        {
            Location::where('id', $rider->riderDetail->home_location->id)->update([
                'city' => $request->home_city,
                'state' => $request->home_state,
                'country' => $request->home_country,
                'long' => $request->home_long,
                'lat' => $request->home_lat,
                'whole_address' => $request->home_whole_address,
            ]);

        }else{
            $home_location = Location::create([
                'city' => $request->home_city,
                'state' => $request->home_state,
                'country' => $request->home_country,
                'long' => $request->home_long,
                'lat' => $request->home_lat,
                'whole_address' => $request->home_whole_address,
            ]);
            Rider_detail::where('rider_id', $id)->update(['home_location_id'=>$home_location->id]);
        }

        if(isset($rider->riderDetail->work_location))
        {
            Location::where('id', $rider->riderDetail->work_location->id)->update([
                'city' => $request->home_city,
                'state' => $request->home_state,
                'country' => $request->home_country,
                'long' => $request->home_long,
                'lat' => $request->home_lat,
                'whole_address' => $request->home_whole_address,
            ]);

        }else{
            $work_location = Location::create([
                'city' => $request->home_city,
                'state' => $request->home_state,
                'country' => $request->home_country,
                'long' => $request->home_long,
                'lat' => $request->home_lat,
                'whole_address' => $request->home_whole_address,
            ]);
            Rider_detail::where('rider_id', $id)->update(['work_location_id'=>$work_location->id]);
        }

         Rider_detail::where('rider_id', $id)->update([
             'date_of_birth'=> $request->date_of_birth,
             'gender'=> $request->gender,
         ]);

        if($request->hasFile('driving_license'))
        {
            $driving_files = $request->file('driving_license');
            $driving_fileData = $this->multiple_document($driving_files);
            Rider_detail::where('rider_id', $id)->update([
                'driving_license'=> $driving_fileData
            ]);
        }

        if($request->hasFile('photo_id_proof'))
        {
            $proof_files = $request->file('photo_id_proof');
            $proof_fileData = $this->multiple_document($proof_files);
            Rider_detail::where('rider_id', $id)->update([
                'photo_id_proof'=> $proof_fileData
            ]);
        }

        if($request->hasFile('vehicle_insurance'))
        {
            $insurance_files = $request->file('vehicle_insurance');
            $insurance_fileData = $this->multiple_document($insurance_files);
            Rider_detail::where('rider_id', $id)->update([
                'vehicle_insurance'=> $insurance_fileData
            ]);
        }

        if($request->hasFile('registration_certificate'))
        {
            $registration_files = $request->file('registration_certificate');
            $registration_fileData = $this->multiple_document($registration_files);
            Rider_detail::where('rider_id', $id)->update([
                'registration_certificate'=> $registration_fileData
            ]);
        }


        $notification=array(
            'message'=>'Rider Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('rider.index')->with($notification);
    }

    private function multiple_document($data): array
    {
        $files = $data;
        $fileData = [];
        foreach($files as $file) {
            $path = Storage::disk('public')->put('rider/images', $file);
            array_push($fileData, $path);
        }

        return $fileData;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rider::destroy($id);
        $notification=array(
            'message'=>'Rider Deleted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
