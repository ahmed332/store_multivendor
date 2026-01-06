<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AccessTokensController extends Controller
{
    public function store(Request $request)
    {
       
        $request->validate([
            'email'       => 'required|email|max:225',
            'password'    => 'required|string|min:5',
            'device_name' => 'nullable|string|max:225',
        ]);

        
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid email or password',
            ], 401); 
        }

        $device_name = $request->device_name ?? $request->userAgent();

        $token = $user->createToken($device_name)->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => $user,
        ], 200);
    }

    // public function destroy(Request $request)
    // {
    //     // ✅ تسجيل الخروج (مسح التوكن الحالي)
    //     $request->user()->currentAccessToken()->delete();

    //     return response()->json([
    //         'message' => 'Logged out successfully'
    //     ]);
    // }
    public function destroy($token=null){
        $user = Auth::guard('Sanctum')->user() ;
        $PersonalAccessToken = PersonalAccessToken::findToken($token);
        if(
            $user->id == $PersonalAccessToken->tokenable_id &&
            get_class($user) == $PersonalAccessToken->tokenable_type
        ){
            $PersonalAccessToken->delete();
        }
    }
}
