<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;
use App\Models\User;
use App\Models\Category;

class NoteSeeder extends Seeder
{

    public function run(): void
    {
        $user = User::first();
        $category = Category::first();

        Note::create([
            'title' => 'First Note',
            'content' => 'This is a sample note.',
            'user_id' => $user->id,
            'category_id' => $category->id
        ]);
    }
}
