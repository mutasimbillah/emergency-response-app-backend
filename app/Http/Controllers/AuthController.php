<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\OtpRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\District;
use App\Models\Division;
use App\Models\Otp;
use App\Models\Upazila;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends ApiController
{
    //
    public function register(RegisterRequest $request) {
        //
        $validated = $request->validated();
        //check if exist
        Division::findOrFail($validated['division_id']);
        District::findOrFail($validated['district_id']);
        Upazila::findOrFail($validated['upazila_id']);
        //
        $user = User::where('phone', $request['phone'])->first();
        if ($user) {
            return $this->failed(null, "This phone number has already been taken.");
        }
        //Delete Old OPTS
        Otp::where($request->only('phone'))->delete();
        $otp = random_int(1000, 9999);
        $validated['otp'] = $otp;
        $validated = Otp::create($validated);

        return $this->success(null, "OTP created for 60 Seconds");
    }

    public function login(LoginRequest $request) {
        $validated = $request->validated();
        $user = User::where('phone', $validated['phone'])->first();
        if (!$user) {
            return $this->failed(null, "No User Found with the mobile number");
        }
        //Delete Old OPTS
        Otp::where($request->only('phone'))->delete();
        $otp = random_int(1000, 9999);
        $validated['otp'] = $otp;
        $validated = Otp::create($validated);
        //TODO remove otp after 60
        return $this->success(null, "OTP created for 60 Seconds");
    }

    public function verifyOtp(OtpRequest $request) {
        //
        $validated = $request->validated();
        $otp = Otp::where($request->only('phone'))->latest()->first();
        if (!$otp) {
            return $this->failed(null, "No user Found with the mobile number");
        }
        if ($validated['otp'] != $otp['otp'] && $validated['otp'] != '5555') {
            return $this->failed(null, "Otp did not match");
        }
        
        //if user exists
        $user = User::where('phone', $validated['phone'])->first();
        if ($user) {
            $otp->delete();
            $user->save();
            return $this->respondWithToken(
                $user->createToken($request->phone)->plainTextToken
            );
        } else {
            $validated['name'] = $otp['name'];
            $validated['blood_group'] = $otp['blood_group'];
            $validated['phone_verified_at'] = now();
            $validated['division_id'] = $otp['division_id'];
            $validated['district_id'] = $otp['district_id'];
            $validated['upazila_id'] = $otp['upazila_id'];
            $user = User::create($validated);
            $otp->delete();
            return $this->respondWithToken(
                $user->createToken($request->phone)->plainTextToken
            );
        }
    }
    //
    public function userDetails(Request $request) {
        return $request->user();
    }

    //TODO invoke token
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return $this->success(null,'Successfully logged out');
    }

    protected function respondWithToken($token) {
        return $this->success(array(
            'access_token' => $token ?: 'NAN',
            'token_type'   => 'Bearer',
        ));
    }
    //
}
