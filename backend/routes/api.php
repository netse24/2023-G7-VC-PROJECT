<?php

use App\Http\Controllers\AdminController;
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
Route::get('/user',[UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/{id}',[UserController::class, 'show']);
Route::put('/user/{id}',[UserController::class, 'update']);
Route::delete('/user/{id}',[UserController::class, 'destroy']);


Route::get('/admin',[AdminController::class, 'index']);
Route::post('/admin', [AdminController::class, 'store']);
Route::get('/admin/{id}',[AdminController::class, 'show']);
Route::put('/admin/{id}',[AdminController::class, 'update']);
Route::delete('/admin/{id}',[AdminController::class, 'destroy']);


Route::get('/student',[StudentController::class, 'index']);
Route::post('/student', [StudentController::class, 'store']);
Route::get('/student/{id}',[StudentController::class, 'show']);
Route::put('/student/{id}',[StudentController::class, 'update']);
Route::delete('/student/{id}',[StudentController::class, 'destroy']);


Route::get('/teacher',[TeacherController::class, 'index']);
Route::post('/teacher', [TeacherController::class, 'store']);
Route::get('/teacher/{id}',[TeacherController::class, 'show']);
Route::put('/teacher/{id}',[TeacherController::class, 'update']);
Route::delete('/teacher/{id}',[TeacherController::class, 'destroy']);


Route::get('/role',[RoleController::class, 'index']);
Route::post('role', [RoleController::class, 'store']);

