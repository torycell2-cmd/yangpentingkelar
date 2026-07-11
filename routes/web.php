<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AiTutorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\QuestionController;

Route::redirect('/', '/dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('forum', ForumController::class);
Route::post('/forum/{id}/comment', [ForumController::class, 'storeComment'])->name('forum.comment');
Route::get('/comment/{id}/edit', [ForumController::class, 'editComment'])->name('comment.edit');
Route::put('/comment/{id}', [ForumController::class, 'updateComment'])->name('comment.update');
Route::delete('/comment/{id}', [ForumController::class, 'destroyComment'])->name('comment.destroy');

Route::get('/ai-tutor', [AiTutorController::class, 'index'])->name('ai.index');

Route::get('/register-choice', function () {
    return view('auth.register_choice');
})->name('register.choice');

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ARTIKEL
    |--------------------------------------------------------------------------
    */

    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/search', [ArticleController::class, 'index'])->name('articles.search');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::resource('articles', ArticleController::class)->except(['index', 'create', 'store']);

   /*
    |--------------------------------------------------------------------------
    | QUIZ
    |--------------------------------------------------------------------------
    */

    Route::resource('quiz', QuizController::class);

    Route::patch('/quiz/{id}/approve',
        [QuizController::class, 'approve'])
        ->name('quiz.approve');

    /*
    |--------------------------------------------------------------------------
    | QUESTION
    |--------------------------------------------------------------------------
    */

        Route::get('/quiz/{quiz}/questions',
            [QuestionController::class, 'index'])
            ->name('questions.index');

        Route::get('/quiz/{quiz}/questions/create',
            [QuestionController::class, 'create'])
            ->name('questions.create');

        Route::post('/quiz/{quiz}/questions',
            [QuestionController::class, 'store'])
            ->name('questions.store');

        Route::get('/quiz/{quiz}/play', [QuestionController::class, 'play'])
            ->name('questions.play');

        Route::post('/quiz/{quiz}/submit', [QuestionController::class, 'submit'])
            ->name('questions.submit');
            
    /* ===========================
        HASIL QUIZ
        ===========================
    */

        Route::get('/quiz-results',
            [QuizController::class, 'results'])
            ->name('quiz.results');
    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin'])->group(function () {

        Route::get('/admin/dashboard', [AdminController::class, 'index']);

        Route::patch('/admin/articles/{id}/approve',
            [ArticleController::class, 'approve'])
            ->name('admin.articles.approve');

    });

    /*
    |--------------------------------------------------------------------------
    | GURU
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin,guru'])->group(function () {

        Route::get('/guru/input-nilai',
            [GuruController::class, 'create']);

    });

    /*
    |--------------------------------------------------------------------------
    | SISWA
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:siswa,admin'])->group(function () {

        Route::get('/siswa/tugas',
            [SiswaController::class, 'index']);

    });

});