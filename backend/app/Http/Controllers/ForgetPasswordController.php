<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPassword;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{
    //
    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $user = User::where('email', $request->email)->first();
        $random_code = rand(111111, 999999);
        $user->verify_code = $random_code;
        $user->save();
        $data = [
            'verify_code' => $random_code,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email
        ];
        Mail::to($request->email)->send(new ForgetPassword($data));
        return response()->json([
            'message' => 'Verify Code sent successfully'
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('verify_code', '=', $request->verify_code)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Incorrect verify code'
            ], 404);
        } else {
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json([
                'message' => 'Password reset successfully'
            ], 200);
        }
    }
}
