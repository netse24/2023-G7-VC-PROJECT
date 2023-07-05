<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admin =Admin::all();
        return response()->json(['success'=>true, 'data'=>$admin], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin =Admin::store($request);
        return response()->json(['success'=>true,'data'=>$admin], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin =Admin::find($id);
        if(!$admin){
            return response()->json(['massage'=>'Not Found'],404);
        }
        $admin = new AdminResource($admin);
        return response()->json(['success'=>true,'data'=>$admin], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin =Admin::store($request, $id);
        return response()->json(['success'=>true, 'data' => $admin], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin =Admin::find($id);
        $admin ->delete();
        return response()->json(['success'=>true, 'message' => 'Data delete successfully'], 200);
    }
}
