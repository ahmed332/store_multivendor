<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccessTokensController extends Controller
{
    public function store(Request $request)
    {
        // ✅ التحقق من البيانات
        $request->validate([
            'email'       => 'required|email|max:225',
            'password'    => 'required|string|min:5',
            'device_name' => 'nullable|string|max:225',
        ]);

        // ✅ البحث عن المستخدم
        $user = User::where('email', $request->email)->first();

        // ✅ التحقق من صحة الإيميل والباسورد
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid email or password',
            ], 401); // 401 Unauthorized
        }

        // ✅ لو المستخدم صحيح → إنشاء التوكن
        $device_name = $request->device_name ?? $request->userAgent();

        $token = $user->createToken($device_name)->plainTextToken;

        // ✅ رجع التوكن مع بيانات المستخدم
        return response()->json([
            'token' => $token,
            'user'  => $user,
        ], 200);
    }

    public function destroy(Request $request)
    {
        // ✅ تسجيل الخروج (مسح التوكن الحالي)
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
