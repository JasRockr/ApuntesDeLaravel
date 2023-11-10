<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\NoteResource;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResource
    {
        // Get all notes
        // $notes = Note::all();
        // Rest API
        // Return json response (data, status code, headers [Optional])
        // return response()->json(Note::all(), 200);
        return NoteResource::collection(Note::all());
    }

    /**
     * Create a new resource and save it.
     */
    public function store(NoteRequest $request):JsonResponse
    {
        // Create element with values from request
        $note = Note::create($request->all());
        return response()->json([
            'success' => true,
            'data' => new NoteResource($note)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):JsonResource
    {
        $note = Note::find($id);
        // return response()->json($note, 200);
        return new NoteResource($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, string $id):JsonResponse
    {
        $note = Note::find($id);
        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();

        return response()->json([
            'success' => true,
            'data' => new NoteResource($note)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Note::find($id)->delete();
        return response()->json([
            'success' => true,
        ], 200);
    }
}
