<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\questionController;
use App\Http\Controllers\adminQuizController;
use App\Http\Controllers\quizController;
use App\Http\Controllers\judgeController;
use App\Http\Controllers\unauthorizedAccess;
use App\Http\Middleware\CheckNormalUserRole;
use App\Http\Middleware\CheckUserRole;
use App\Http\Middleware\judgeRole;
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
    Route::get('/quiz-details/{detail}', [adminQuizController::class, 'quizDetails'])->name('adminQuizDetails');
    Route::get('/disability', [adminQuizController::class, 'disability'])->name('disability');
    Route::post('/disability/create', [adminQuizController::class, 'disabilityCreate'])->name('disabilty-create');
    Route::delete('/disability/{disability}/delete',[adminQuizController::class, 'deleteDisabiltiy'])->name('delete-disability');
    Route::get('/disability/{disability}/edit',[adminQuizController::class, 'editDisability'])->name('edit-disability');
    Route::put('/disability/{disability}/update',[adminQuizController::class, 'updateDisability'])->name('update-disability');
});

Route::middleware (['auth', judgeRole::class])->group(function (){
    Route::get('/Judge-Dashboard', [adminQuizController::class, 'getQuizTakers'])->name('judge-dashboard');
    Route::get('/Judge-quiz-details/{detail}', [adminQuizController::class, 'quizDetails'])->name('judgeQuizDetails');
});

Route::middleware(['auth', CheckNormalUserRole::class])->group(function () {
    Route::get('/user-home', [quizController::class, 'userHome'])->name('user-home');
    Route::get('/quiz', [quizController::class, 'quiz'])->name('quiz');
    Route::post('/quiz', [quizController::class, 'questionAnswer'])->name('submit-answer');
    Route::get('/final-score', [quizController::class, 'score'])->name('final-score');
});

Route::get('unauthorized', [unauthorizedAccess::class, 'unauthorized'])->name('unauthorized')->middleware('auth');
