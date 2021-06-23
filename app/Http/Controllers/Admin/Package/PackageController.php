<?php

namespace App\Http\Controllers\Admin\Package;

use App\DataTables\PackageDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Vendor\Package;
use App\Models\Vendor\PackageFile;
use App\Models\Vendor\Vendor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\Package\PackageRequest;

class PackageController extends Controller
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
    public function index(PackageDataTable $dataTable)
    {
        return $dataTable->render('package.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $vendors = Vendor::get();
        return view('package.create', compact('categories','vendors'));
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
        if($request->hasFile('receiver_signature_image'))
        {
            $path = Storage::disk('public')->put('vendor/package', $request->receiver_signature_image);
            $input['receiver_signature_name'] = $path;
        }
        $input['tracking_id'] =  (string) Str::uuid()->getHex();
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

        $notification=array(
            'message'=>'Package Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin_package.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::find($id);
        return view('package.show',compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        $categories = Category::get();
        $vendors = Vendor::get();
        return view('package.edit',compact('package','categories','vendors'));
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

        $notification=array(
            'message'=>'Package Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('admin_package.index')->with($notification);
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
        return response()->json(['message'=>'Package Deleted Successfully', 'type'=> 'success']);

    }
}
