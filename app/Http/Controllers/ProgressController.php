<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        $progress = Progress::where('user_id', auth()->id())->with('word')->get();
        return view('progress.index', compact('progress'));
    }
}
