<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseScoreResource;
use App\Models\CourseScore;
use App\Models\Term;
use Illuminate\Http\Request;


class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terms = Term::orderBy('term')->get();
        $terms = Term::all();
        return response()->json(['success' => true, 'data' => $terms], 200);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
      
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $term = Term::find($id);
        $courseScore = CourseScore::where('term_id',$id)->get();
        if (!$term) {
            return response()->json(['massage' => 'Not Found'], 404);
        }
        $courseScore = CourseScoreResource::collection($courseScore);
        return response()->json(['success' => true, 'data' => $courseScore], 200);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Term $term)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   
       
    public function update($request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */   
    public function destroy($id)
    {
    }
}
