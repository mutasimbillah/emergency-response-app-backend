<?php

use App\Events\NewMessage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BloodRequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/test', function () {
    event(new NewMessage('This is our first msg'));
    return now();
});
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('verify-otp', [AuthController::class, 'verifyOtp']);

Route::group(array('middleware' => array('auth:sanctum')), function () {
    Route::get('user', array(AuthController::class, 'userDetails'));
    Route::apiResource('blood', BloodRequestController::class);
    Route::post('logout', array(AuthController::class, 'logout'));
});