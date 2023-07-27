<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $teacher = Teacher::all();
        $teacher = TeacherResource::collection($teacher);
        return response()->json(['success' => true, 'data' => $teacher], 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function getAllTeachersForSchedule(Request $request)
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
        } else {
            $query->where('roles.name', '=', 'teacher');
        }
        $teacher = $query->get();
        return response()->json(['success' => true, 'data' => $teacher], 200);
    }
    public function getTeachers(Request $request)
    {
        $query = DB::table('teachers')
            ->join('users', 'users.id', '=', 'teachers.user_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->select('teachers.*', 'users.first_name', 'users.last_name', 'users.gender', 'courses.course');
        // Get date by query
        $queryParams = $request->all();
        if (count($queryParams) > 0) {
            foreach ($queryParams as $key => $value) {
                $query->where($key, '=', $value);
                $query->where('roles.name', '=', 'teacher');
            };
        } else {
            $query->where('roles.name', '=', 'teacher');
        }
        $teacher = $query->get();
        return response()->json(['success' => true, 'data' => $teacher], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $findInUser = User::find($id);
        // // $findInUser = User::where('id', '=', $teacher->user_id)->first();
        // $findInUser->delete();
        // return response()->json(['success' => true, 'message' => 'Teacher delete successfully'], 200);
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['success' => true, 'message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete user'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        $teachers = Teacher::all();
        foreach ($teachers as $teacher) {
            if ($teacher['user_id'] == $user->id) {
                $teacher = new TeacherResource($teacher);
                return response()->json(['success' => true, 'data' => $teacher], 200);
            }
        }
        $user = User::find($id);

        $teacher = Teacher::where('user_id', '=', $user->id);
        if (!$user) {
            return response()->json(['massage' => 'Not Found'], 404);
        }
        $teacher = new TeacherResource($teacher);
        return response()->json(['success' => true, 'data' => $teacher], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
