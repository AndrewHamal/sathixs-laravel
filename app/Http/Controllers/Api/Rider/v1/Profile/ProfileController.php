<?php

namespace App\Http\Controllers\Api\Rider\v1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rider\v1\RiderProfileRequest;
use App\Models\Rider;
use App\Models\Rider_detail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        return Rider::with('riderDetail')->paginate(10);
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
     * @return
     */
    public function show($id)
    {
        return Rider::with('riderDetail')->findOrFail($id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RiderProfileRequest $request,Rider $rider)
    {
        $rider->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email
        ]);

        Rider_detail::where('rider_id',$rider->id)->update([
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender
        ]);

        $riders = $rider->load('riderDetail');
        return response([
            'message' => 'Rider Updated Successfully',
            'data' => $riders
        ]);
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
        return response([
            'status'=> 200,
            'message'=> 'Riders Deleted Successfully!'
        ]);
    }
}
