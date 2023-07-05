<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Teacher::all();
        return response()->json(['success'=>true, 'data'=>$teacher], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $teacher = Teacher::store($request);
        return response()->json(['success'=>true,'data'=>$teacher], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::find($id);
        if(!$teacher){
            return response()->json(['massage'=>'Not Found'],404);
        }
        $teacher = new TeacherResource($teacher);
        return response()->json(['success'=>true,'data'=>$teacher], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::store($request, $id);
        return response()->json(['success'=>true, 'data' => $teacher], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::find($id);
        $teacher ->delete();
        return response()->json(['success'=>true, 'message' => 'Data delete successfully'], 200);
    }
}
