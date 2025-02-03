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
        $notes = $this->noteService->getAllNotes();
        return $this->success($notes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request): JsonResponse
    {
        $notes = $this->noteService->createNote($request->validated());
        return $this->success($notes, 'Note created successfully.', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note): JsonResponse
    {
        $notes = $this->noteService->getNoteById($note->id);
        return $this->success($notes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note): JsonResponse
    {
        $note = $this->noteService->updateNote($note, $request->validated());
        return $this->success($note, 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note): JsonResponse
    {
        $this->noteService->deleteNote($note);
        return $this->success(null, 'Note deleted successfully.');
    }
}
