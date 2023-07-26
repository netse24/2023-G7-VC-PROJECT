<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use GuzzleHttp\Psr7\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userAsStuent = User::find($request['student_id']);
        $findStudent = Student::where('user_id', '=', $userAsStuent->id)->first();

        $userAsTeacher = User::find($request['teacher_id']);
        $findTeacher = Teacher::where('user_id', '=', $userAsTeacher->id)->first();
        // // $term = Term::find($request->term_id);

        // $feedback = Feedback::create([
        //     'feedback' => $request['feedback'],
        //     'student_id' => $findStudent->id,
        //     'teacher_id' => $findTeacher->id,
        //     'term_id' => $request['term_id'],
        // ]);
        return $findTeacher;
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
