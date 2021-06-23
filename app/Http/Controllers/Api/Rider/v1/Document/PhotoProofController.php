<?php

namespace App\Http\Controllers\Api\Rider\v1\Document;

use App\Http\Controllers\Controller;
use App\Models\Rider\Rider_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoProofController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rider_detail $photoProof)
    {
        $validated = $request->validate([
            'photo_id_proof' => 'required|array',
            'photo_id_proof.*' => 'image|mimes:jpeg,png,jpg,pdf,svg|max:2048'
        ]);

        $files = $request->file('photo_id_proof');
        $fileData = [];
        foreach($files as $file) {
            $path = Storage::disk('public')->put('rider/images', $file);
            array_push($fileData, $path);
        }
        $photoProof->update(['photo_id_proof'=>$fileData]);

        return response([
            'message'=> 'Document Uploaded',
            'data' => $photoProof
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
        $files = Rider_detail::select('photo_id_proof')->where('rider_id', auth()->user()->id)->first();
        $arr = $files->photo_id_proof;
        if(array_key_exists($arrayKey, $arr)){
            Storage::disk('public')->delete($arr[$arrayKey]);
            unset($arr[$arrayKey]);
            $file_arr = array_values($arr);
            Rider_detail::where('rider_id', auth()->user()->id)->update(['photo_id_proof'=>$file_arr]);

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
