<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentGenerationListResource;
use App\Http\Resources\StudentResource;
use App\Models\Generation;
use App\Models\Student;
use Illuminate\Http\Request;

class GenerationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generation = Generation::orderBy('name', 'desc')->get();
        return response()->json(['success' => true, 'data' => $generation], 200);


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
     * Remove the specified resource from storage.
     */
    public function destroy(Generation $generation)
    {
        //
    }
    // public function getStudentList($id){
    //     $studentList = Generation::leftJoin('students', 'students.generation_id','=','generations.id')
    //                            ->leftJoin('locations', 'events.location_id','=','locations.id')
    //                            ->select('generations.name','students.matching_country','matchings.time','locations.location','events.amount_of_ticket','matchings.matching_description')
    //                            ->where('generation_id',$id)
    //                            ->get();
    //     return response()->json(['success'=> true, 'data'=>$studentList],200);
        
    // }
}
