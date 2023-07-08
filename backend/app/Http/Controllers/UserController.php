<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return response()->json(['success'=>true,'data'=>$user], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::store($request);
        return response()->json(['success'=>true,'data'=>$user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['massage'=>'Not Found'],404);
        }
        $user = new UserResource($user);
        return response()->json(['success'=>true,'data'=>$user], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::store($request, $id);
        return response()->json(['success'=>true, 'data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user ->delete();
        return response()->json(['success'=>true, 'message' => 'Data delete successfully'], 200);
    }

    
    /**
     * Search name of user.
     */
    public function searchUserName($searchUser)
    {
        $user = User::where('first_name', 'like','%' .$searchUser .'%')->get();
        return $user;
    }
}