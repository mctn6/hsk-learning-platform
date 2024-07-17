<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;

class FlashcardController extends Controller
{
    protected $flashcardModel;

    public function __construct()
    {
        $this->flashcardModel = new Flashcard();
    }

    public function index()
    {
        $flashcards = $this->flashcardModel->all();
        return view('flashcards.index', compact('flashcards'));
    }
}
