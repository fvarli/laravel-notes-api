<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Services\NoteService;
use App\Models\Note;
use Illuminate\Http\JsonResponse;

class NoteController extends Controller
{

    protected NoteService $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json($this->noteService->getAllNotes());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request): JsonResponse
    {
        return response()->json($this->noteService->createNote($request->validated()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note): JsonResponse
    {
        return response()->json($this->noteService->getNoteById($note->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note): JsonResponse
    {
        $this->noteService->updateNote($note, $request->validated());
        return response()->json(['message' => 'Note updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note): JsonResponse
    {
        $this->noteService->deleteNote($note);
        return response()->json(['message' => 'Note deleted successfully.']);
    }
}
