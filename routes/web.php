<?php

use App\Http\Controllers\FlashcardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [FlashcardController::class, 'index'])->name('flashcards');
    
// Quizzes Routes
Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes');
Route::post('/quizzes/{quiz}/answer', [QuizController::class, 'answer'])->name('quizzes.answer');

// Progress Routes
Route::get('/progress', [ProgressController::class, 'index'])->name('progress');

Route::get('/words', [WordController::class, 'index'])->name('words');
