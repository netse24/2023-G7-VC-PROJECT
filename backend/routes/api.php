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
Route::post('/login', [AuthController::class,'login']);


Route::post('/login', [AuthController::class,'login']);
Route::resource('teacher', TeacherController::class);
Route::resource('student', StudentController::class);
Route::resource('user', UserController::class);
Route::resource('admin', AdminController::class);
Route::resource('role', RoleController::class);
Route::resource('class', ClasseController::class);
Route::resource('course', CourseController::class);
Route::get('/generation',[StudentController::class, 'getgeneration']);





