<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Http\Requests\StoreTermRequest;
use App\Http\Requests\UpdateTermRequest;
use App\Http\Requests\TranscriptRequest;
use App\Models\Transcript;
use Illuminate\Http\Request;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terms = Term::orderBy('term', 'desc')->get();
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
    public function store(TranscriptRequest $request)
    {
        $transcript = Transcript::create([
            "title" => $request->title,
            "term"=> $request->term,
            "student_id"=> $request->student_id,
        
        ]);
        return response()->json([
            "success"=> true,
            "message"=>"Create Transcript successfull",
            'data' =>  $transcript
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Term $term)
    {
        //
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
    public function update(TranscriptRequest $request, string $id)
    {
        $transcript = Transcript::find($id)->update([
            "title" => $request->title,
            "term"=> $request->term,
            "student_id"=> $request->student_id,
        
        ]);
        return response()->json([
            "success"=> true,
            "message"=>"Update transcript successfull",
            'data' => $transcript
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Term $term)
    {
        Transcript::find($id)->delete();
        return response()->json([
            "success"=> true,
            "message"=>"Delete transcript successfull",
        ],200);
    }
}
