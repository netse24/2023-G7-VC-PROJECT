<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseScoreController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\GenerationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\TranscriptController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);

// get user by if with their if store in cookie

Route::middleware(['auth:sanctum'])->group(function () {
    // protect route if they are not allowed by authenticated user
    Route::get('/users/getByIdCookie/{id}', [UserController::class, "getUserById"]);
    Route::get('/users/auth', [AuthController::class, "getUserByAuth"]);
    Route::post('/logout', [UserController::class, "logoutUser"]);
    Route::put('/changepass', [ResetPasswordController::class, "changePassword"]);
    Route::resource('students', StudentController::class);
    Route::delete('/users/delete/{ids}', [UserController::class, 'delete'])->name('deleteMultiple');
    Route::get('search/{name}', [UserController::class, 'searchUserByName']);

    Route::get('/teachers/background/{id}', [TeacherController::class, 'show']);
    Route::get('/students/background/{id}', [StudentController::class, 'show']);
});

Route::resource('users', UserController::class);
Route::get('generation/{name}', [GenerationController::class, 'searchGeneration']);
Route::resource('rooms', RoomController::class);
Route::resource('classes', ClasseController::class);
Route::resource('courses', CourseController::class);
Route::resource('generations', GenerationController::class);
Route::resource('teachers', TeacherController::class);
Route::get('/getAllTeacher', [TeacherController::class, 'getAllTeachersForSchedule']);

Route::resource('students', StudentController::class);
Route::resource('schedule', ScheduleController::class);
Route::resource('scores', CourseScoreController::class);
Route::resource('transcripts', TranscriptController::class);
Route::resource('term', TermController::class);

Route::get('/getStudentByUserId/{UserId}', [StudentController::class, 'getStudentByUserId']);
Route::get('/getTeacherByUserId/{UserId}', [UserController::class, 'update']);

Route::post('/forget_password', [ForgetPasswordController::class, 'forgetPassword']);
Route::post('/reset_password', [ForgetPasswordController::class, 'resetPassword']);
Route::get('/student_course_score/{stud_id}', [StudentController::class, 'getStudentCourseScore']);

Route::resource('feedback', FeedbackController::class);
Route::get('/getScoreById/{courseScoreId}', [CourseScoreController::class, 'getScoreById']);
// Route::get('/getfeedbacks', [FeedbackController::class, 'index']);
// Route::post('/getfeedback', [FeedbackController::class, 'store']);
// Route::get('/getfeedback/{id}', [FeedbackController::class, 'show']);
