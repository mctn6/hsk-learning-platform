<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlashcardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $words = DB::table('words')->get();

        foreach ($words as $word) {
            DB::table('flashcards')->insert([
                'word_id' => $word->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
