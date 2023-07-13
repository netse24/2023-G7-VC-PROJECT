<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('teachers')
        ->join('users', 'users.id', '=', 'teachers.user_id')
        ->join('courses', 'courses.id', '=', 'teachers.course_id')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->select('teachers.*', 'users.first_name', 'users.last_name', 'users.gender', 'courses.course');
        // Get date by query
        $queryParams = $request->all();
        if (count($queryParams) > 0) {
            foreach ($queryParams as $key => $value) {
                $query->where($key, '=', $value);
                $query->where('roles.name', '=', 'teacher');
            };
        }else {
            $query->where('roles.name', '=', 'teacher');
        }
        $teacher = $query->get();
        return response()->json(['success'=>true, 'data'=>$teacher], 200);
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
        $teacher =Teacher::find($id);
        $teacher -> delete();
        return response()->json(['success'=>true, 'message' => 'Teacher delete successfully'], 200);
    }
}
