<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\AnswersController;
use App\Http\Controllers\AcceptAnswerController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\VoteQuestionController;
use App\Http\Controllers\VoteAnswerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
})->name('dashboard');

Route::view('/{any}', 'spa');
    
Route::get('/',[QuestionsController::class,'index']);

Route::middleware('verified')->group(function() {

        Route::resource('questions', QuestionsController::class)->except('show','index');

        Route::resource('questions.answers', AnswersController::class)->except(['create','show','index']);

        //Route::post('questions/{question}/answers',[AnswersController::class,'store'])->name('answers.store');

        Route::post('/answers/{answer}/accept',AcceptAnswerController::class)->name('answers.accept');

        Route::post('/questions/{question}/favorites',[FavoritesController::class,'store'])->name('questions.favorite');

        Route::delete('/questions/{question}/favorites',[FavoritesController::class,'destroy'])->name('questions.unfavorite');

        Route::post('/questions/{question}/vote',VoteQuestionController::class);

        Route::post('/answers/{answer}/vote',VoteAnswerController::class);

});

Route::get('/questions/{question}/answers',[AnswersController::class,'index'])->name('questions.answers.index');
Route::get('/questions/{slug}',[QuestionsController::class,'show'])->name('questions.show');
Route::get('/questions',[QuestionsController::class,'index'])->name('questions.index');