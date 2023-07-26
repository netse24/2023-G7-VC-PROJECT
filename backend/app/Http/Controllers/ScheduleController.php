<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScheduleResource;
use App\Http\Resources\StudentResource;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('schedules')
            ->join('courses', 'courses.id','=','schedules.course_id')
            ->join('teachers', 'teachers.id','=','schedules.teacher_id')
            ->join('classes', 'classes.id','=','schedules.class_id')
            ->join('rooms', 'rooms.id','=','schedules.room_id')
            ->join('users', 'users.id','=','teachers.user_id')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->select('schedules.*', 'users.first_name', 'users.last_name', 'users.gender' ,'roles.name as role', 'courses.course', 'classes.name as className', 'rooms.name as roomName');
        // Add conditions to filter the results
        $queryParams = $request->all();
        if (count($queryParams) > 0) {
            foreach ($queryParams as $key => $value) {
                $query->where("schedules.$key", '=', $value);
            };
        } else {
            $query->where('roles.name', '=', 'teacher');
        }
        // Get the final result
        $schedule = $query->get();
        return response()->json(['success' => true, 'data' => $schedule], 200);
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
        return response()->json(['message' => 'Schedule Successfully Created!', 'data' =>$schedule], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);
        if(!$schedule) {
            return response()->json(['message' => 'Not fount'], 404);
        }
        $schedule = new ScheduleResource($schedule);
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
