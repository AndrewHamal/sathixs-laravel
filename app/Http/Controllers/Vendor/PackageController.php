<?php

namespace App\Http\Controllers\Vendor;

use App\Events\RiderPackage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\PackageRequest;
use App\Models\Location;
use App\Models\Vendor\Package;
use App\Models\Vendor\PackageFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = \request('search');
        $type = \request('type');
        $package = Package::query();
        $package->where('vendor_id', Auth::user()->id);

        if($type == 1){
            $package->whereHas('packageStatus', fn($row) => $row->where('process_step', '!=', 3));
        }

        if($type == 2){
            $package->whereHas('packageStatus', fn($row) => $row->where('process_step', 3));
        }

        if($search != '') {
            return $package
                ->where('tracking_id', $search)
                ->paginate();
        }
        return $package->orderBy('updated_at', 'DESC')->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        $input = $request->all();

        $location = Location::create($input['location']);
        $input['vendor_id'] = Auth::user()->id;
        $input['tracking_id'] =  (string) Str::uuid()->getHex();

        unset($input['receiver_address']);

        $input['receiver_address'] = $location->id;
        $package = Package::create($input);

        $package_files = [];
        if ( $request->hasFile('image')){
            $packageInstance = new Package();
            $files = $packageInstance->uploadFiles($request->image);
            foreach ($files as $file)
            {
                $file['package_id'] =  $package->id;
                $package_file = PackageFile::create($file);
                array_push($package_files, $package_file);
            }
        }

        // after store send notification to all the rider
        broadcast(new RiderPackage([Package::find($package->id)]));

        return response([
            'status' => true,
            'message'=> 'Package successfully created',
            'data' => ['package' => $package, 'package_files' => $package_files]
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Package::findOrfail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Package::findOrfail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, $id)
    {
        $input = $request->all();
        $input['vendor_id'] = Auth::user()->id;
        $package = Package::findOrfail($id)
        ->update($input);

        $package = Package::findOrfail($id);

        $package_files = [];
        if ( $request->hasFile('image')){
            $packageInstance = new Package();
            $files = $packageInstance->uploadFiles($request->image);
            foreach ($files as $file)
            {
                $file['package_id'] =  $package->id;
                $package_file = PackageFile::create($file);
                array_push($package_files, $package_file);
            }
        }
        return response([
            'status' => true,
            'message'=> 'Package successfully updated',
            'data' => ['package' => $package, 'package_files' => $package_files]
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Package::destroy($id);

        return response([
            'status' => true,
            'message'=> 'Package deleted successfully',
        ], Response::HTTP_ACCEPTED);
    }

}
