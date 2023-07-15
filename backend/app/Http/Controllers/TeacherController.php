<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShowTeacherResource;
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
    public function index()
    {
        $teacher = Teacher::all();
        $teacher = TeacherResource::collection($teacher);
        return response()->json(['success'=>true, 'data'=>$teacher], 200);
    }
    $teacher = $query->get();
    return response()->json(['success' => true, 'data' => $teacher], 200);
  }
  /**
   * Store a newly created resource in storage.
   */

  /**
   * Display a listing of the resource.
   */
  public function getAll()
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
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $teacher = Teacher::find($id);
    $findInUser = User::where('id', '=', $teacher->user_id)->first();
    $findInUser->delete();
    return response()->json(['success' => true, 'message' => 'Teacher delete successfully'], 200);
  }
  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    $teacher = Teacher::find($id);
    if (!$teacher) {
      return response()->json(['massage' => 'Not Found'], 404);
    }
    $teacher = new TeacherResource($teacher);
    return response()->json(['success' => true, 'data' => $teacher], 200);
  }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher =Teacher::find($id);
        $findInUser = User::where('id' ,'=', $teacher->user_id)->first();
        $findInUser -> delete();
        return response()->json(['success'=>true, 'message' => 'Teacher delete successfully'], 200);
    }
  }
}
