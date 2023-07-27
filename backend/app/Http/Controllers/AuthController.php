<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      $user = Auth::user();
      $findRole = Role::where('id', '=', $user->role_id)->first();

      if ($findRole->name === 'admin') {
        $token = $user->createToken('adminToken', ['create, update, delete, edit'])->plainTextToken;
      } else if ($findRole->name === 'teacher') {
        $token = $user->createToken('teacherToken', ['view', 'edit'])->plainTextToken;
      } else if ($findRole->name === 'student') {
        $token = $user->createToken('studentToken', ['view only'])->plainTextToken;
      }
      return response()->json(
        [
          'message' => 'Login successful',
          'token' => $token,
          'user' => new UserResource($user),
        ],
        202
      );
    } else {
      return response()->json(['message' => 'Invalid login', 'email' => request()->email, 'password' => request()->password], 404);
    }
  }

  public function getUserByAuth()
  {
    $user = Auth::user();
    if (!$user) {
      return response()->json(['message' => 'User not found'], 404);
    }
    $user = new UserResource($user);
    return response()->json(
      [
        'message' => 'success',
        'data' => $user
      ],
      200
    );
  }
}
