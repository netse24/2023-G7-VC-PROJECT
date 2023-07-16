<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowTeacherResource;
use App\Http\Resources\TeacherResource;
use App\Http\Resources\UserResource;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $teacher = Teacher::all();
    return response()->json(['success' => true, 'data' => $teacher], 200);
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
    $user = User::find($id);
    $teacher = Teacher::where('user_id', '=', $user->id)->first();
    $teacher = new TeacherResource($teacher);
    if (!$teacher) {
      return response()->json(['massage' => 'Not Found'], 404);
    }
    // $teacher = new TeacherResource($teacher);
    return response()->json(['success' => true, 'data' => $teacher], 200);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $teacher = Teacher::store($request, $id);
    return response()->json(['success' => true, 'data' => $teacher], 200);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $teacher = Teacher::find($id);
    $teacher->delete();
    return response()->json(['success' => true, 'message' => 'Teacher delete successfully'], 200);
  }

  public function getTeacherInfor($id)
  {
    $teacher = Teacher::where('id', $id)->first();
    if (!empty($teacher)) {
      $user = new ShowTeacherResource($teacher);
      if (!empty($user)) {
        return response()->json([
          'success' => true,
          'message' => 'Get Teacher successfully',
          'teacher_info' => $user
        ]);
      }
    } else {
      return response()->json([
        'message' => 'Teacher not found',
      ]);
    }
  }
}
