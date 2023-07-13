<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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
Route::resource('admin', AdminController::class);
Route::resource('schedule', ScheduleController::class);

// get user by if with their if store in cookie 

Route::middleware(['auth:sanctum'])->group(function () {
    // protect route if they are not allowed by authenticated user
    Route::get('/users/{id}', [UserController::class, "getUserById"]);
    Route::post('/logout', [UserController::class, "logoutUser"]);
    Route::post('/check_email', [ResetPasswordController::class, "resetPasswordPost"]);
    Route::put('/changepass', [ResetPasswordController::class, "resetNewPasswordController"]);
    Route::resource('users', UserController::class);
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('classes', ClasseController::class);
    Route::resource('courses', CourseController::class);
    Route::delete('/users/delete/{ids}', [UserController::class, 'delete'])->name('deleteMultiple');
    Route::get('search/{name}', [UserController::class, 'searchUserByName']);
    Route::resource('schedule', ScheduleController::class);
    Route::get('/teacher/{ids}', [TeacherController::class, 'getTeacherInfo']);
    Route::get('/getteachers', [TeacherController::class, 'getAll']);
});
