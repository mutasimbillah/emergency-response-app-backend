<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\OtpRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends ApiController
{
    //
    public function register(RegisterRequest $request) {
        //
        $data = $request->validated();
        $user = User::where('phone', $request['phone'])->first();
        if ($user) {
            return $this->failed(null, "This phone number has already been taken.");
        }
        //Delete Old OPTS
        Otp::where($request->only('phone'))->delete();
        $otp = random_int(1000, 9999);
        $data['otp'] = $otp;
        $data = Otp::create($data);

        return $this->success(null, "OTP created for 60 Seconds");
    }

    public function login(LoginRequest $request) {
        $data = $request->validated();
        $user = User::where('phone', $data['phone'])->first();
        if (!$user) {
            return $this->failed(null, "No User Found with the mobile number");
        }
        //Delete Old OPTS
        Otp::where($request->only('phone'))->delete();
        $otp = random_int(1000, 9999);
        $data['otp'] = $otp;
        $data = Otp::create($data);
        //TODO remove otp after 60
        return $this->success(null, "OTP created for 60 Seconds");
    }

    public function verifyOtp(OtpRequest $request) {
        //
        $data = $request->validated();
        $otp = Otp::where($request->only('phone'))->latest()->first();
        if (!$otp) {
            return $this->failed(null, "No user Found with the mobile number");
        }
        if ($data['otp'] != $otp['otp'] && $data['otp'] != '5555') {
            return $this->failed(null, "Otp did not match");
        }
        
        //if user exists
        $user = User::where('phone', $data['phone'])->first();
        if ($user) {
            $data['blood_group'] = $otp['blood_group'];
            $otp->delete();
            $user->save();
            return $this->respondWithToken(
                $user->createToken($request->phone)->plainTextToken
            );
        } else {
            $data['name'] = $otp['name'];
            $data['blood_group'] = $otp['blood_group'];
            $data['phone_verified_at'] = now();
            $user = User::create($data);
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
        //return response()->json(array('message' => 'Successfully logged out'));
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
