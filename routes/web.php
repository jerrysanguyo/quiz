<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\questionController;
use App\Http\Controllers\quizController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// question
Route::get('/question',[questionController::class, 'question'])->name('question')->middleware('auth');
Route::post('/question',[questionController::class, 'addQuestion'])->name('add-question')->middleware('auth');
Route::get('/question/{question}/edit',[questionController::class, 'editQuestion'])->name('edit-question')->middleware('auth');
Route::put('/question/{question}/update',[questionController::class, 'updateQuestion'])->name('update-question')->middleware('auth');
Route::delete('/question/{question}/delete',[questionController::class, 'deleteQuestion'])->name('delete-question')->middleware('auth');
// exam
Route::get('/quiz',[quizController::class, 'quiz'])->name('quiz')->middleware('auth');