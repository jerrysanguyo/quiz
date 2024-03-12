<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\questionController;
use App\Http\Controllers\adminQuizController;
use App\Http\Controllers\quizController;
use App\Http\Controllers\judgeController;
use App\Http\Middleware\CheckUserRole;
use App\Http\Controllers\unauthorizedAccess;
use App\Http\Middleware\CheckNormalUserRole;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', CheckUserRole::class])->group(function () {
    Route::get('/home', [adminQuizController::class, 'getQuizTakers'])->name('takers');
    // question
    Route::get('/question',[questionController::class, 'listOfQuestion'])->name('question');
    Route::get('/question/create',[questionController::class, 'formQuestion'])->name('question-form');
    Route::post('/question',[questionController::class, 'addQuestion'])->name('add-question');
    Route::get('/question/{question}/edit',[questionController::class, 'editQuestion'])->name('edit-question');
    Route::put('/question/{question}/update',[questionController::class, 'updateQuestion'])->name('update-question');
    Route::delete('/question/{question}/delete',[questionController::class, 'deleteQuestion'])->name('delete-question');
    Route::get('/quiz-details/{detail}', [adminQuizController::class, 'quizDetails'])->name('quizDetails');
});

Route::middleware (['auth', judgeRole::class])->group(function (){
    Route::get('/Judge-Dashboard', [judgeController::class, 'judgeDashboard'])->name('judge-dashboard');
});

Route::middleware(['auth', CheckNormalUserRole::class])->group(function () {
    Route::get('/user-home', [quizController::class, 'userHome'])->name('user-home');
    Route::get('/quiz', [quizController::class, 'quiz'])->name('quiz');
    Route::post('/quiz', [quizController::class, 'questionAnswer'])->name('submit-answer');
    Route::get('/final-score', [quizController::class, 'score'])->name('final-score');
});
// Route::get('/home', [QuizController::class, 'getQuizTakers'])->name('takers');
//     // question
//     Route::get('/question',[questionController::class, 'listOfQuestion'])->name('question');
//     Route::get('/question/create',[questionController::class, 'formQuestion'])->name('question-form');
//     Route::post('/question',[questionController::class, 'addQuestion'])->name('add-question');
//     Route::get('/question/{question}/edit',[questionController::class, 'editQuestion'])->name('edit-question');
//     Route::put('/question/{question}/update',[questionController::class, 'updateQuestion'])->name('update-question');
//     Route::delete('/question/{question}/delete',[questionController::class, 'deleteQuestion'])->name('delete-question');
//     Route::get('/quiz-details/{detail}', [QuizController::class, 'quizDetails'])->name('quizDetails');
//     Route::get('/quiz', [QuizController::class, 'quiz'])->name('quiz');
//     Route::post('/quiz', [QuizController::class, 'questionAnswer'])->name('submit-answer');
//     Route::get('/final-score', [QuizController::class, 'score'])->name('final-score');
Route::get('unauthorized', [unauthorizedAccess::class, 'unauthorized'])->name('unauthorized')->middleware('auth');
