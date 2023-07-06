<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        // find user email 
        $user = User::where('email', request()->email)->first();
        // check password

        if (!$user || !Hash::check(request()->password, $user->password)) {
            return response()->json(['message' => 'invalid', 'email' => request()->email, 'password' => request()->password], 404);
        } else {
            $findRole = Role::where('id', '=', $user->role_id)->first('roles.name');
            if ($findRole->name === 'admin') {

                $token = $user->createToken('adminToken', ['create, update, delete, edit'])->plainTextToken;
                return response()->json(
                    [
                        'admin-token' => $token,
                        'user' => $user,
                        'role' => $findRole,
                    ],
                    202
                );
            } else if ($findRole->name === 'teacher') {
                $token = $user->createToken('teacherToken', ['view'])->plainTextToken;
                return response()->json(
                    [
                        'teacher-token' => $token,
                        'user' => $user,
                        'role' => $findRole,
                    ],
                    202
                );
            } else if ($findRole->name === 'student') {
                $token = $user->createToken('studentToken', ['view only'])->plainTextToken;
                return response()->json(
                    [
                        'student-token' => $token,
                        'user' => $user,
                        'role' => $findRole,
                    ],
                    202
                );
            }
        }
    }
}
