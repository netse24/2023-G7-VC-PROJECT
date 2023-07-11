<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentClassResource;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::all();
        // $students = $student->groupBy('class_id');
        $student = StudentResource::collection($student);
        return response()->json(['success'=>true, 'data'=>$student], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);
        if(!$student){
            return response()->json(['massage'=>'Not Found'],404);
        }
        $student = new StudentResource($student);
        return response()->json(['success'=>true,'data'=>$student], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::store($request,$id);
        return response()->json(['success'=>true, 'data' =>$student], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student= Student::find($id);
        $student->delete();
        return response()->json(['success'=>true, 'message' => 'Student delete successfully'], 200);
    }
    // public function getgeneration(){
    //     $students = DB::table('students')
    //     ->select('generation')
    //     ->distinct()
    //     ->get();

    //     return response()->json(['success' => true, 'data' => $students], 200);
    // }
    // public function getClass(){
    //     $students = DB::table('students')
    //     ->select('class_id')
    //     ->distinct()
    //     ->get();
    //     return response()->json(['success' => true, 'data' => $students], 200);

    // }
}

