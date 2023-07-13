<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScheduleResource;
use App\Http\Resources\StudentResource;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedule = Schedule::all();
        return response()->json(['Here is all schedules', 'data' => $schedule], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required',
            'teacher_id' => 'required',
            'class_id' => 'required',
            'room_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        if($validator->fails()) {
            return $validator->errors();
        }
        $schedule = Schedule::create($validator->validated());
        return response()->json(['message' => 'Schedule Successfully Created!'], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Schedule $id)
    {
        $schedule = Schedule::find($id);
        if(!$schedule) {
            return response()->json(['message' => 'Not fount'], 404);
        }
        $schedule = new StudentResource($schedule);
        return response()->json(['message' =>'Here is all schedules', 'data' =>$schedule], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);
        $schedule->update($request->all());
        $schedule = new ScheduleResource($schedule);
        return response()->json(['Message' => 'Schedule successfully updated!', 'schedule' => $schedule], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $id)
    {
        $student= Schedule::find($id);
        $student->delete();
        return response()->json(['success'=>true, 'message' => 'Student delete successfully'], 200);
    }
}
