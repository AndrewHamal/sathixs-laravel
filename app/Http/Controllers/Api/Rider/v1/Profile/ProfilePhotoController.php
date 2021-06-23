<?php

namespace App\Http\Controllers\Api\Rider\v1\Profile;

use App\Http\Controllers\Controller;
use App\Models\Rider\Rider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePhotoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'profile_photo' => ['required','image','mimes:jpeg,png,jpg,heic','max:2048']
        ]);
        $path = Storage::disk('public')->put('rider/images', $request->profile_photo);

        Rider::where('id', auth()->user()->id)->update([
            'profile_photo' =>  $path
        ]);

        return response([
            'status_code'=> 200,
            'message'=> 'Profile Upload successfully!',
            'data' => $path
        ]);
    }
}
