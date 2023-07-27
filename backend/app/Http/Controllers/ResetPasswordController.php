<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => 'required|min:8|regex:/[a-zA-Z]/',
            'new_password' => 'required|min:8|regex:/[a-zA-Z]/',
        ]);
        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->new_password),
            ]);
            return response()->json(['message' => 'Password updated successfully.'], 200);
        }
        return response()->json(['message' => 'The current password is incorrect.'], 404);
    }
}
