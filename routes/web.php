<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AiTutorController;

Route::redirect('/', '/dashboard');

Route::get(
    '/dashboard',
    [DashboardController::class,'index']
)->name('dashboard');

Route::resource(
    'articles',
    ArticleController::class
);
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::post('/articles/search', [ArticleController::class, 'search'])->name('articles.search');

Route::resource( 
    'forum',
    ForumController::class
);

Route::post(
    '/forum/{id}/comment',
    [ForumController::class, 'storeComment']
)->name('forum.comment');

Route::resource(
    'quiz',
    QuizController::class
);

Route::get(
    '/ai-tutor',
    [AiTutorController::class,'index']
)->name('ai.index');

Route::get(
    '/comment/{id}/edit',
    [ForumController::class, 'editComment']
)->name('comment.edit');

Route::put(
    '/comment/{id}',
    [ForumController::class, 'updateComment']
)->name('comment.update');

Route::delete(
    '/comment/{id}',
    [ForumController::class, 'destroyComment']
)->name('comment.destroy');
Route::middleware(['auth'])->group(function (){
    //Route yang bisa di askes apabila sudah login
    Route::resource('articles' , ArticleController::class);
});