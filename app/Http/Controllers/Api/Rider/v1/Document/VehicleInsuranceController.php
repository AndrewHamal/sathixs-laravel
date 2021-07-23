<?php

namespace App\Http\Controllers\Api\Rider\v1\Document;

use App\Http\Controllers\Controller;
use App\Models\Rider\Rider_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehicleInsuranceController extends Controller
{

    public function update(Request $request)
    {
        $insurance = Rider_detail::find(Auth::user()->id);
        $request->validate([
            'file' => 'required',
            'file.*' => 'image|mimes:jpeg,png,jpg,pdf,svg|max:2048'
        ]);

        $file = $request->file('file');
        $fileData = [];

        if(@count($insurance->vehicle_insurance)){
            $fileData = $insurance->vehicle_insurance;
        }

        $path = Storage::disk('public')->put('rider/images', $file);
        array_push($fileData, $path);
        $insurance->update(['vehicle_insurance'=>$fileData]);

        return response([
            'message'=> 'Document Uploaded',
            'data' => $insurance
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($arrayKey)
    {
        $files = Rider_detail::select('vehicle_insurance')->where('rider_id', auth()->user()->id)->first();
        $arr = $files->vehicle_insurance;
        if(array_key_exists($arrayKey, $arr)){
            Storage::disk('public')->delete($arr[$arrayKey]);
            unset($arr[$arrayKey]);
            $file_arr = array_values($arr);
            Rider_detail::where('rider_id', auth()->user()->id)->update(['vehicle_insurance'=>$file_arr]);

            return response([
                'message' => 'Doucment Deleted!',
                'data' => $file_arr
            ]);
        }else{
            return response([
                'error' => 'File not found'
            ]);
        }

    }
}
