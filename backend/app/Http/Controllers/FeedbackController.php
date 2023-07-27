<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeedbackResource;
use App\Http\Resources\ShowStudentFeedbackResource;
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
    public function show($id)
    {
        $user = User::find($id);
        $student = Student::where('user_id', '=', $user->id)->first();
        $getfeedback = new ShowStudentFeedbackResource($student);
        return $getfeedback;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        // $feedback = Feedback::find($id);
        // $feedback->update([
        //     'feedback' => $request->feedback,
        //     'student_id' => $request->student_id,
        //     'teacher_id' => $request->teacher_id,
        //     'term_id' => $request->term_id,
        // ]);
        // // $feedback->update($request->all());
        // return response()->json(['Message' => 'Feedback successfully updated!'], 200);

        try {
            $feedback = Feedback::findOrFail($id); // Use findOrFail to throw an exception if the record is not found
            $feedback->update([
                'feedback' => $request->input('feedback'),
                'student_id' => $request->input('student_id'),
                'teacher_id' => $request->input('teacher_id'),
                'term_id' => $request->input('term_id'),
            ]);

            // Success message or further actions
            return response()->json(['message' => 'Feedback updated successfully']);
        } catch (\Exception $e) {
            // Error handling
            return response()->json(['message' => 'Failed to update feedback'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
