<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Database\Eloquent\Collection;

class NoteService
{
    public function getAllNotes(): Collection
    {
        return Note::all();
    }

    public function getNoteById(int $id): ?Note
    {
        return Note::find($id);
    }

    public function createNote(array $data): Note
    {
        return Note::create($data);
    }

    public function updateNote(Note $note, array $data): bool
    {
        return $note->update($data);
    }

    public function deleteNote(Note $note): bool
    {
        return $note->delete();
    }
}
