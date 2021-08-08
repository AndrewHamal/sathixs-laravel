<?php

namespace App\Http\Controllers\Api\Rider\v1\Document;

use App\Http\Controllers\Controller;
use App\Models\Rider\Rider_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DrivingLicenseController extends Controller
{

    public function update(Request $request)
    {
        $license = Rider_detail::find(Auth::user()->id);
        $request->validate([
            'file' => 'required',
            'file.*' => 'image|mimes:jpeg,png,jpg,pdf,svg|max:2048'
        ]);

        $file = $request->file('file');
        $fileData = [];

        if(@count($license->driving_license ?? [])){
            $fileData = $license->driving_license;
        }

        $path = Storage::disk('public')->put('rider/images', $file);
        array_push($fileData, $path);
        $license->update(['driving_license'=>$fileData]);

        return response([
            'message'=> 'Document Uploaded',
            'status' => 'done'
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
        $files = Rider_detail::select('driving_license')->where('rider_id', auth()->user()->id)->first();
        $arr = $files->driving_license;
        if(array_key_exists($arrayKey, $arr)){
            Storage::disk('public')->delete($arr[$arrayKey]);
            unset($arr[$arrayKey]);
            $file_arr = array_values($arr);
            Rider_detail::where('rider_id', auth()->user()->id)->update(['driving_license'=>$file_arr]);

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
