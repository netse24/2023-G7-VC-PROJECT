<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Student;
use PhpParser\Node\Stmt\Class_;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class = Classes::all();
        return response()->json(['success'=>true, 'data'=>$class], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $class = Classes::store($request);
        return response()->json(['success'=>true,'data'=>$class], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = Classes::find($id);
        $student = Student::where('class_id',$id)->get();
        if (!$class) {
            return response()->json(['massage' => 'Not Found'], 404);
        }
        $class = StudentResource::collection($student);
        return response()->json(['success' => true, 'data' => $class], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
