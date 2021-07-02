<?php

namespace App\Http\Controllers\Vendor_web\Packages;

use App\DataTables\Vendor_web\PackageDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor_web\Packages\PackageRequest;
use App\Http\Requests\Vendor_web\Packages\UpdatePackageRequest;
use App\Models\Category;
use App\Models\Vendor\Package;
use App\Models\Vendor\PackageFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PackageController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth:vendor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PackageDataTable $dataTable)
    {
        return $dataTable->render('vendor_web.packages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('vendor_web.packages.create', compact('categories'));
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
        $input['vendor_id'] = Auth::user()->id;
        $input['tracking_id'] =  (string) Str::uuid()->getHex();
        $package = Package::create($input);

        if ( $request->hasFile('image')){
            $packageInstance = new Package();
            $files = $packageInstance->uploadFiles($request->image);
            foreach ($files as $file)
            {
                $file['package_id'] =  $package->id;
                $package_file = PackageFile::create($file);
            }
        }

        $notification=array(
            'message'=>'Package Added Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('package.index')->with($notification);

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
        return view('vendor_web.packages.show',compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::get();
        $package = Package::where('id', $id)->first();

        return view('vendor_web.packages.edit', compact('categories','package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request, $id)
    {
        Package::findOrfail($id)->update([
            'category_id' => $request->category_id,
            'no_of_package' => $request->no_of_package,
            'receiver_name' => $request->receiver_name,
            'receiver_address' => $request->receiver_address,
            'receiver_phone' => $request->receiver_phone,
            'product_price' => $request->product_price,
            'weight' => $request->weight,
            'special_instruction' => $request->special_instruction,
            'vendor_id' => Auth::user()->id,
        ]);

        $package = Package::findOrfail($id);
        if ( $request->hasFile('image')){
            // delete previous file
            if(!empty($request->arr_ids)) {
                foreach($request->arr_ids as $row) {
                    PackageFile::destroy($row);
                }
            }

            // then add new files
            $packageInstance = new Package();
            $files = $packageInstance->uploadFiles($request->image);

            foreach ($files as $file)
            {
                $file['package_id'] =  $package->id;
                $package_file = PackageFile::create($file);
            }
        }

        $notification=array(
            'message'=>'Package updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('package.index')->with($notification);
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
