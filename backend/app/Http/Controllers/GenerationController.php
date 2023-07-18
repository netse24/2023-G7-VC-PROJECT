<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentGenerationListResource;
use App\Http\Resources\StudentResource;
use App\Models\Classes;
use App\Models\Generation;
use App\Models\Student;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
use Symfony\Component\VarDumper\Cloner\Stub;
>>>>>>> 8b329a056a9c04f54e9270e392451bdf89d2011a

class GenerationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generation = Generation::orderBy('name', 'desc')->get();
        return response()->json(['success' => true, 'data' => $generation], 200);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $generation = Generation::find($id);
        $students = Student::where('generation_id',$id)->get();
        if (!$generation) {
            return response()->json(['massage' => 'Not Found'], 404);
        }
        $generation = StudentResource::collection($students);
        return response()->json(['success' => true, 'data' => $generation], 200);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Generation $generation)
    {
        //
    }
    /**
     * search generation.
     */
    public function searchGeneration($searchGeneration)
    {
      $searchUserName = DB::table('Generations')
        ->where('name', 'like', '%' . $searchGeneration . '%')
        ->get();
      return $searchUserName;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Generation $generation)
    {
        //
    }
}
