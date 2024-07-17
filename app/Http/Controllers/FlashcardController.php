<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use Illuminate\Http\Request;

class FlashcardController extends Controller
{
    public function index()
    {
        // $flashcards = Flashcard::with('word')->get();
        return view('flashcards.index');
    }

}
