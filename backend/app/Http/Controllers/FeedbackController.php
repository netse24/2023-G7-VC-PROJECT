<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedback = Feedback::all();
        $feedback = FeedbackResource::collection($feedback);
        return response()->json(['success' => true, 'data' => $feedback], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userAsStuent = User::find($request->student_id);
        $findStudent = Student::where('user_id', '=', $userAsStuent->id)->first();

        $userAsTeacher = User::find($request->teacher_id);
        $findTeacher = Teacher::where('user_id', '=', $userAsTeacher->id)->first();
        // // $term = Term::find($request->term_id);

        $feedback = Feedback::create([
            'feedback' => $request->feedback,
            'student_id' => $findStudent->id,
            'teacher_id' => $findTeacher->id,
            'term_id' => $request->term_id,
        ]);
        return $feedback;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
