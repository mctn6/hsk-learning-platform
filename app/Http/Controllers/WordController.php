<?php

namespace App\Http\Controllers;

use App\Models\Word;

class WordController extends Controller
{
    protected $wordModel;

    public function __construct()
    {
        $this->wordModel = new Word();
    }

    public function index()
    {
        $words = $this->wordModel->all();
        return view('words.index', compact('words'));
    }
}
