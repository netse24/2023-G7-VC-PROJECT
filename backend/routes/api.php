<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RoleController;
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

// get user by if with their if store in cookie 

Route::middleware(['auth:sanctum'])->group(function () {
    // protect route if they are not allowed by authenticated user
    Route::get('/users/{id}', [UserController::class, "getUserById"]);
    Route::post('/logout', [UserController::class, "logoutUser"]);
});

Route::resource('teacher', TeacherController::class);
Route::resource('student', StudentController::class);
Route::resource('users', UserController::class);
Route::resource('course', CourseController::class);
