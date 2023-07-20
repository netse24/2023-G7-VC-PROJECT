<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Classes;
use App\Models\Generation;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Student::all();
        $student = StudentResource::collection($student);
        return response()->json(['success' => true, 'data' => $student], 200);
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
    public function show($id)
    {
        $users = User::find($id);
        $students = Student::all();
        foreach ($students as $student){
          if($student['user_id'] == $users->id){
            $student = new StudentResource($student);
            return response()->json(['success' => true, 'data' => $student], 200);
        
        };
        //findOrFail($id)bec
        // $user = User::findOrFail($id);
        // $student = Student::where('user_id', '=', $user->id)->first();
        // if (!$user) {
        //     return response()->json(['massage' =>'Not Found'], 404);
        // }
        // $student = new StudentResource($student);
        // return response()->json(['success' => true, 'data' => $student], 200);
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update($request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        $findInUser = User::where('id', '=', $student->user_id)->first();
        $findInUser->delete();
        return response()->json(['success' => true, 'message' => 'Student delete successfully'], 200);
    }
    public function getStudentByUserId($userId)
    {
        $student = User::find($userId);
        if (!$student) {
            return response()->json(['massage' => 'Not Found'], 404);
        }
        return response()->json(['success' => true, 'data' => $student], 200);
    }
}
