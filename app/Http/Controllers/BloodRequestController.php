<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Http\Requests\CreateBloodRequest;
use App\Http\Resources\BloodRequestResource;
use App\Models\BloodRequest;
use Illuminate\Http\Request;

class BloodRequestController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bloodRequests = BloodRequest::all();
        
        return $this->success(
            BloodRequestResource::collection($bloodRequests)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBloodRequest $request)
    {
        //
        $validated = $request->validated();
        //TODO check if Exist
        $bloodRequest = BloodRequest::create($validated);
        return $this->success(
            BloodRequestResource::make($bloodRequest), 
            "A request has been created"
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BloodRequest $bloodRequest)
    {
        //
        return $this->success(
            BloodRequestResource::make($bloodRequest)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
