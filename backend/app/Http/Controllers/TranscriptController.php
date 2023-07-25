<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranscriptRequest;
use App\Models\Transcript;
use Illuminate\Http\Request;

class TranscriptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function destroy(string $id)
    {
        Transcript::find($id)->delete();
        return response()->json([
            "success"=> true,
            "message"=>"Delete transcript successfull",
        ],200);
    }
}
