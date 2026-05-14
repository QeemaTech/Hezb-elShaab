<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:225',
            'email' => 'required|string|max:225|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'birth_date' => 'required|date',
            'national_id' => 'required|max:14|unique:members,national_id',
            'member_id' => 'required|string|max:191|unique:members,membership_number',
        ]);
        $code = 123456;
        //random_int(100000, 999999);
        $member = Member::create([
            'national_id' => $request->national_id,
            'membership_number' => $request->member_id,
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'national_id' => $request->national_id,
            'birth_date' => $request->birth_date,
            'member_id' => $member->id,
            'member_status' => 'pending',
            'status' => 0,
            'code' => $code,
        ]);
        return response()->json([
            'message' => 'تم إنشاء حسابك بنجاح، يرجى إتمام عملية تأكيد رقم الهاتف لتفعيل الحساب.',
            'debug_code' => $code,
            'data'    => $user->load('member')
        ]);
    }
    public function verifyPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,phone',
            'code'  => 'required|digits:6'
        ]);

        $user = User::where('phone', $request->phone)->first();

        if ($request->code != '123456') {
            return response()->json([
                'message' => __('messages.invalid_verification_code')
            ], 422);
        }

        $user->status = 1;
        $user->phone_verified_at = Carbon::now();
        $user->code = null;
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => __('messages.phone_verified_successfully'),
            'data' => [
                'token' => $token,
                'user'  => $user,
            ]
        ], 200);
    }
    public function login(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:225',
            'phone' => 'required|exists:users,phone',
        ]);
        $user = User::where('phone', $request->phone)->where('name',$request->name)->first();
        if(!$user){
                return response()->json([
                'message' => __('messages.wrong_name_or_phone'),
            ], 422);
        }
        // $code = random_int(100000, 999999);
        if(!$user->phone_verified_at){
            $code = 123456;
            $user->code = $code;
            $user->save();
            return response()->json([
                'message' => __('messages.please_verifiy_phone_to_login'),
                // 'debug_code' => $code
            ], 200);
        }else{
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => __('messages.user_loged_successfully'),
                'data' => [
                    'token' => $token,
                    'user'  => $user,
                ]
            ], 200);
        }
    }
    public function loginOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,phone',
            'code'  => 'required|digits:6'
        ]);

        $user = User::where('phone', $request->phone)->first();

        if ($user->status != 1) {
            return response()->json([
                'message' => __('messages.you_account_is_inactivated')
            ], 422);
        }

        if ($user->code !== $request->code) {
            return response()->json([
                'message' => __('messages.invalid_verification_code')
            ], 422);
        }

        if (!$user->phone_verified_at) {
            $user->phone_verified_at = now();
        }

        $user->code = null;
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => __('messages.user_loged_successfully'),
            'data' => [
                'token' => $token,
                'user'  => $user,
            ]
        ], 200);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => __('messages.logged_out_successfully')
        ], 200);
    }
    public function profile(){
        $user = Auth::user();
        return response()->json($user);
    }
}
