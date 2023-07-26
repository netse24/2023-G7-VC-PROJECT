<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Http\Resources\FeedbackResource;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
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
    public function store(StoreFeedbackRequest $request)
    {
        $validatedData = $request->validate([
            'feedback' => 'required|string',
            'student_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'transcript_id' => 'required|integer',
        ]);
        $feedback = Feedback::create($validatedData);
        return response()->json(['message' => 'Feedback created successfully', 'data' => $feedback]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feedback = Feedback::find($id);
        if(!$feedback) {
            return response()->json(['message' => 'Not fount'], 404);
        }
        $feedback = new FeedbackResource($feedback);
        return response()->json(['message' =>'Here is a feedback', 'data' =>$feedback], 200);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackRequest $request, Feedback $id)
    {
        $feedback =Feedback::store($request, $id);
        return response()->json(['success'=>true, 'data' => $feedback], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete();
        return response()->json(['success' => true, 'message' => 'Data delete successfully'], 200);
    }
}
