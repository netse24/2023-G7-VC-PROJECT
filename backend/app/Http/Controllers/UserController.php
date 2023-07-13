<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Generation;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return response()->json(['success' => true, 'data' => $user], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
            $user = User::create($request->input('user'));
            $userId = $user->id;
            $role = $user->role_id;
            if ($role == 2) {
                $teacherData = $request->input('teacher');
                $courses = Course::all();
                foreach ($courses as $course) {
                    $courseData = $request->input('course');
                    if (!Course::where('course', $courseData['course'])->exists()) {
                        $newCourse = Course::create($courseData);
                        $courseId = $newCourse->id;
                        $teacherData['user_id'] = $userId;
                        $teacherData['course_id'] = $courseId;
                        $teacher = Teacher::create($teacherData);
                        return response()->json([
                            'success' => true,
                            'user' => $user,
                            'teacher' => $teacher,
                            'course' => $newCourse
                        ], 201);
                    } else {
                        $courseId = $course->id;
                        $teacherData['user_id'] = $userId;
                        $teacherData['course_id'] = $courseId;
                        $teacher = Teacher::create($teacherData);
                        return response()->json([
                            'success' => true,
                            'user' => $user,
                            'teacher' => $teacher,
                            'course' => $course
                        ], 201);
                    }
                }
            } else if ($role == 3) {
                $studentData = $request->input('student');
                $generationData = $request->input('generation');
                $classData = $request->input('class');
                if (!Generation::where('name', $generationData['name'])->exists()) {
                    $newGeneration = Generation::create($generationData);
                    $generationId = $newGeneration->id;
                    if (!Classes::where('name', $classData['name'])->exists()) {
                        $newClass = Classes::create($classData);
                        $classId = $newClass->id;
                        $studentData['user_id'] = $userId;
                        $studentData['class_id'] = $classId;
                        $studentData['generation_id'] = $generationId;
                        $student = Student::create($studentData);
                        return response()->json([
                            'success' => true,
                            'user' => $user,
                            'student' => $student,
                        ], 201);
                    } else {
                        $classes = Classes::all();
                        foreach ($classes as $class) {
                            if ($class['name'] == $classData['name']) {
                                $classId = $class['id'];
                            }
                        }
                        $studentData['user_id'] = $userId;
                        $studentData['class_id'] = $classId;
                        $studentData['generation_id'] = $generationId;
                        $student = Student::create($studentData);
                        return response()->json([
                            'success' => true,
                            'user' => $user,
                            'student' => $student,
                        ], 201);
                    }
                } elseif (Generation::where('name', $generationData['name'])->exists()) {
                    $generations = Generation::all();
                    foreach ($generations as $generation) {
                        if ($generation->name == $generationData['name']) {
                            $generationId = $generation->id;
                        }
                    }
                    if (!Classes::where('name', $classData['name'])->exists()) {
                        $newClass = Classes::create($classData);
                        $classId = $newClass->id;
                        $studentData['user_id'] = $userId;
                        $studentData['class_id'] = $classId;
                        $studentData['generation_id'] = $generationId;
                        $student = Student::create($studentData);
                        return response()->json([
                            'success' => true,
                            'user' => $user,
                            'student' => $student,
                            'class' => $newClass,
                            'generation' => $generation
                        ], 201);
                    } else {
                        $classes = Classes::all();
                        foreach ($classes as $class) {
                            if ($class['name'] == $classData['name']) {
                                $classId = $class['id'];
                            }
                        }
                        $studentData['user_id'] = $userId;
                        $studentData['class_id'] = $classId;
                        $studentData['generation_id'] = $generationId;
                        $student = Student::create($studentData);
                        return response()->json([
                            'success' => true,
                            'user' => $user,
                            'student' => $student,
                        ], 201);
                    }
                }
            }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['massage' => 'Not Found'], 404);
        }
        $user = new UserResource($user);
        return response()->json(['success' => true, 'data' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::store($request, $id);
        return response()->json(['success' => true, 'data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['success' => true, 'message' => 'Data delete successfully'], 200);
    }
}
