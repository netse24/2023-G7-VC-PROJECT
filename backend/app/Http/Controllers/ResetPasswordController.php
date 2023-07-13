<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    //

    public function resetPasswordPost(Request $request)
    {
        $user = Auth::user();
        $email = User::where('email', '=', $user->email )->first();
        if ($email) {
            return response()->json([
                'status' => 'success',
            ], 200);
        } else {
            return response()->json([
                'status' => 'not found',
            ], 404);
        }
    }

    public function resetNewPasswordController(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6',
        ]);
        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            return response()->json(['message' => 'Password updated successfully.'], 200);
        }
        return response()->json(['message' => 'The current password is incorrect.'], 404);
    }
}
