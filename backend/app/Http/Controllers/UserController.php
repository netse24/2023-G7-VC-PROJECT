<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\StudentResource;
use App\Http\Resources\UserResource;
use App\Mail\PermissionEmail;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Generation;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
    $userData = $request->input('user');
    $user = User::create($userData);
    $userId = $user->id;
    $role = $user->role_id;
    if ($role == 2) {
      $teacherData = $request->input('teacher');
      $courseData = $request->input('course');
      if (!Course::where('course', $courseData['course'])->exists()) {
        $newCourse = Course::create($courseData);
        $courseId = $newCourse->id;
        $teacherData['user_id'] = $userId;
        $teacherData['course_id'] = $courseId;
        $teacher = Teacher::create($teacherData);
        Mail::to($user->email)->send(new PermissionEmail($user, $user->first_name, $user->last_name, $user->email, $userData['password']));
        return response()->json([
          'success' => true,
          'user' => $user,
          'teacher' => $teacher,
          'course' => $newCourse
        ], 201);
      } else {
        $courses = Course::all();
        foreach ($courses as $course) {
          if ($course['course'] == $courseData['course']) {
            $courseId = $course['id'];
          }
        }
        $teacherData['user_id'] = $userId;
        $teacherData['course_id'] = $courseId;
        $teacher = Teacher::create($teacherData);
        Mail::to($user->email)->send(new PermissionEmail($user, $user->first_name, $user->last_name, $user->email, $userData['password']));
        return response()->json([
          'success' => true,
          'user' => $user,
          'teacher' => $teacher,
          'course' => $course
        ], 201);
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
          Mail::to($user->email)->send(new PermissionEmail($user, $user->first_name, $user->last_name, $user->email, $userData['password']));

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
          Mail::to($user->email)->send(new PermissionEmail($user, $user->first_name, $user->last_name, $user->email, $userData['password']));
          return response()->json([
            'success' => true,
            'user' => $user,
            'student' => $student,
          ], 201);
        }
      } else if (Generation::where('name', $generationData['name'])->exists()) {
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
          Mail::to($user->email)->send(new PermissionEmail($user, $user->first_name, $user->last_name, $user->email, $userData['password']));
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
          Mail::to($user->email)->send(new PermissionEmail($user, $user->first_name, $user->last_name, $user->email, $userData['password']));
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
  public function show($id)
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
  public function update(UpdateUserRequest $request, string $id)
  {
    $users = User::find($id);
    $users->update([
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'gender' => $request->gender,
      'date_of_birth' => $request->date_of_birth,
      'address' => $request->address,
    ]);
    return response()->json(['success' => true, 'data' => $users], 201);
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

  /**
   * Search First, Last Name of the student and teacher.
   */
  public function searchUserByName($searchUser)
  {
    $searchUserName = DB::table('Users')
      ->where('first_name', 'like', '%' . $searchUser . '%')
      ->orWhere('last_name', 'like', '%' . $searchUser . '%')
      ->get();
    return $searchUserName;
  }

  /**
   * select remove 
   */
  public function delete($ids)
  {
    // explode is used to split to individual arrays
    $ids = explode(',', $ids);
    User::whereIn('id', $ids)->delete();
    return response()->json(['message' => 'Users deleted successfully'], 200);
  }
  // get user by id that stored in storage cookie. 
  public function getUserById($id)
  {
    $user = User::where('id', '=', $id)->first();
    if (!$user) {
      return response()->json([
        'message' => 'User not found',
      ], 404);
    }
    $user = new UserResource($user);
    return response()->json([
      'message' => 'Get user successfully ',
      'data' => $user
    ], 200);
  }

  // user to logout user and delete that users' token 
  public function logoutUser()
  {
    Auth::user()->tokens()->delete();
    return response()->json([
      'message' => 'logout user successfully'
    ]);
  }
}
