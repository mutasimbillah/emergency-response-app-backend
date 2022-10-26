<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBloodRequest;
use App\Http\Resources\BloodRequestResource;
use App\Models\BloodRequest;

class BloodRequestController extends ApiController {

    public function index() {
        $bloodRequests = BloodRequest::all();
        return $this->success(
            BloodRequestResource::collection($bloodRequests)
        );
    }

    public function store(CreateBloodRequest $request) {
        $validated = $request->validated();
        //TODO check if Exist
        $bloodRequest = BloodRequest::create($validated);
        return $this->success(
            BloodRequestResource::make($bloodRequest),
            "A request has been created"
        );
    }

    public function show(BloodRequest $bloodRequest) {
        return $this->success(
            BloodRequestResource::make($bloodRequest)
        );
    }

    public function destroy(BloodRequest $bloodRequest) {
        $bloodRequest->delete();
        return $this->success();
    }
}
