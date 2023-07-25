<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseScoreRequest;
use App\Models\CourseScore;
use Illuminate\Http\Request;

class CourseScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $score = CourseScore::all();
        return response()->json([
            "success"=> true,
            "message"=>"Create score successfull",
            'data' => $score
        ],200);
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
        
        ]);
        return response()->json([
            "success"=> true,
            "message"=>"Create score successfull",
            'data' => $score
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
            "student_id"=> $request->student_id,
            "score"=> $request->score,
        
        ]);
        return response()->json([
            "success"=> true,
            "message"=>"Update score successfull",
            'data' => $score
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CourseScore::find($id)->delete();
        return response()->json([
            "success"=> true,
            "message"=>"Delete score successfull",
        ],200);
    }
}
