<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\NoteRequest;

class NoteController extends Controller
{
    //
    public function index(): View
    {
        $notes = Note::all();
        return view('note.index', compact('notes'));
    }

    public function create(): View
    {
        return view('note.create');
    }

    public function store(NoteRequest $request): RedirectResponse
    {
        // Option 1 >>
        // $note = new Note;
        // $note->title = $request->title;
        // $note->description = $request->description;
        // $note->save();

        // Option 2 >>
        // Note::create([
        //     'title' => $request->title,
        //     'description' => $request->description
        // ]);

        // Direct when model = request
        Note::create($request->all());
        return redirect()->route('note.index')->with('success', 'Note is created');
    }

    // public function edit($note)
    // {
    //     $myNote = Note::find($note);
    //     return view();
    // }

    public function edit(Note $note): View
    {
        return view('note.edit', compact('note'));
    }

    public function update(NoteRequest $request, Note $note): RedirectResponse
    {
        // Option 1 >>
        // $note->update([
        //     'title' => $request->title,
        //     'description' => $request->description
        // ]);

        // Option 2 >>
        // $note = Note::find($note);
        // $note->title = $request->title;
        // $note->description = $request->description;
        // $note->save();

        $note->update($request->all());
        return redirect()->route('note.index')->with('success', 'Note updated successfully');
    }

    public function show(Note $note): View
    {
        return view('note.show', compact('note'));
    }

    public function destroy(Note $note): RedirectResponse
    {
        $note->delete();
        return redirect()->route('note.index')->with('danger', 'Note deleted successfully');
    }
}
