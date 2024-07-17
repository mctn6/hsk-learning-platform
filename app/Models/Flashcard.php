<?php

namespace App\Models;

use Illuminate\Support\Facades\File;

class Flashcard
{
    protected $filePath;

    public function __construct()
    {
        $this->filePath = resource_path('data/flashcards.json');
    }
    public function all()
    {
        if (!File::exists($this->filePath)) {
            return [];
        }
        return json_decode(File::get($this->filePath), true);
    }
}
