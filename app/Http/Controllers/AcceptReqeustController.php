<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAcceptRequest;
use App\Http\Resources\AcceptRequestResource;
use App\Models\AcceptRequest;

class AcceptRequestController extends ApiController {
    //
    public function index() {
        $acceptRequests = AcceptRequest::all();
        return $this->success(
            AcceptRequestResource::collection($acceptRequests)
        );
    }

    public function store(CreateAcceptRequest $request) {
        $validated = $request->validated();
        //TODO check if Exist
        $acceptRequest = AcceptRequest::create($validated);
        return $this->success(
            AcceptRequestResource::make($acceptRequest),
            "Request Accepted"
        );
    }

    public function show(AcceptRequest $acceptRequest) {
        return $this->success(
            AcceptRequestResource::make($acceptRequest)
        );
    }

    public function destroy(AcceptRequest $acceptRequest) {
        $acceptRequest->delete();
        return $this->success();
    }
}
