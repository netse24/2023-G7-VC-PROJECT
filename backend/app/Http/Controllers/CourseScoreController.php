<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseScoreRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseScoreResource;
use App\Models\CourseScore;
use App\Http\Resources\ShowStudentResource;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class CourseScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $score = CourseScore::orderBy('id', 'desc')->get();
        $score = CourseScoreResource::collection($score);
        return response()->json([
            "success" => true,
            'data' => $score
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseScoreRequest $request)
    {
        $score = CourseScore::create([
            "course_id" => $request->course_id,
            "student_id"=> $request->student_id,
            "score"=> $request->score,
            "term_id"=> $request->term_id,

        ]);
        return response()->json([
            "success" => true,
            "message" => "Create score successfull",
            'data' => $score
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $user = User::find($id);
        $student = Student::where('user_id', $user->id)->first();
        $coureScore = new ShowStudentResource($student);
        if (!$student) {
            return response()->json([
                "message" => 'Student not found',
            ], 404);
        }
        return response()->json([
            "success" => true,
            'data' => $coureScore
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseScoreRequest $request, string $id)
    {
        $score = CourseScore::find($id)->update([
            "course_id" => $request->course_id,
            "student_id" => $request->student_id,
            "score"=> $request->score,
            "term_id" => $request->term_id,

        ]);
        return response()->json([
            "success" => true,
            "message" => "Update score successfull",
            'data' => $score
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CourseScore::find($id)->delete();
        return response()->json([
            "success" => true,
            "message" => "Delete score successfull",
        ], 200);
    }
    public function getScoreById($id){
        $score = CourseScore::find($id);
        if (!$score) {
            return response()->json(['massage' => 'Not Found'], 404);
        }
        $score = new CourseScoreResource($score);
        return response()->json(['success' => true, 'data' => $score], 200);
    }
}
