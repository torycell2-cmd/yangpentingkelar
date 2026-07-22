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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendController;

Route::redirect('/', '/dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| FORUM
|--------------------------------------------------------------------------
*/

Route::resource('forum', ForumController::class);


Route::post('/forum/{id}/comment', [ForumController::class, 'storeComment'])->name('forum.comment');
Route::get('/comment/{id}/edit', [ForumController::class, 'editComment'])->name('comment.edit');
Route::put('/comment/{id}', [ForumController::class, 'updateComment'])->name('comment.update');
Route::delete('/comment/{id}', [ForumController::class, 'destroyComment'])->name('comment.destroy');
Route::post('/friend/add/{id}', [FriendController::class, 'addFriend'])->name('friend.add');
/*
======================================================================== 
fitur add friend 
===========================================================================
*/
Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
Route::delete('/friend/unfriend/{id}', [FriendController::class, 'unfriend'])->name('friend.unfriend');
Route::post('/friend/accept/{id}', [App\Http\Controllers\FriendController::class, 'acceptFriend'])->name('friend.accept');
Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
Route::post('/forum/{id}/comment', [ForumController::class, 'storeComment'])
    ->name('forum.comment');

Route::get('/comment/{id}/edit', [ForumController::class, 'editComment'])
    ->name('comment.edit');

Route::put('/comment/{id}', [ForumController::class, 'updateComment'])
    ->name('comment.update');

Route::delete('/comment/{id}', [ForumController::class, 'destroyComment'])
    ->name('comment.destroy');


/*
|--------------------------------------------------------------------------
| AI TUTOR
|--------------------------------------------------------------------------
*/

Route::get('/ai-tutor', [AiTutorController::class, 'index'])
    ->name('ai.index');

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::get('/register-choice', function () {
    return view('auth.register_choice');
})->name('register.choice');

/*
|--------------------------------------------------------------------------
| AUTH REQUIRED
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ARTIKEL
    |--------------------------------------------------------------------------
    */

    Route::get('/articles', [ArticleController::class, 'index'])
        ->name('articles.index');

    Route::get('/articles/search', [ArticleController::class, 'index'])
        ->name('articles.search');

    Route::get('/articles/create', [ArticleController::class, 'create'])
        ->name('articles.create');

    Route::post('/articles', [ArticleController::class, 'store'])
        ->name('articles.store');

    Route::get('/articles/{article}', [ArticleController::class, 'show'])
        ->name('articles.show');

    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])
        ->name('articles.edit');

    Route::put('/articles/{article}', [ArticleController::class, 'update'])
        ->name('articles.update');

    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])
        ->name('articles.destroy');

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

    Route::get('/quiz/{quiz}/play',
        [QuestionController::class, 'play'])
        ->name('questions.play');

    Route::post('/quiz/{quiz}/submit',
        [QuestionController::class, 'submit'])
        ->name('questions.submit');

    /*
    |--------------------------------------------------------------------------
    | HASIL QUIZ
    |--------------------------------------------------------------------------
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

        Route::get('/admin/dashboard', 
        [AdminController::class, 'index'])
        ->name('admin.dashboard');

        // ==========================================
        // ROUTE REALTIME STATS ADMIN
        // ==========================================

        Route::get('/admin/api/stats', 
            [AdminController::class, 'getStats'])
            ->name('admin.stats');

        Route::patch('/admin/users/{id}/toggle-status', 
            [AdminController::class, 'toggleStatus'])
            ->name('admin.users.toggle-status');

        Route::get('/admin/articles/pending',
            [ArticleController::class, 'pending'])
            ->name('admin.articles.pending');

        Route::patch('/admin/articles/{id}/approve',
            [ArticleController::class, 'approve'])
            ->name('admin.articles.approve');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
       

    });

    /*
    |--------------------------------------------------------------------------
    | GURU
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin,guru'])->group(function () {

        Route::get('/guru/input-nilai',
            [GuruController::class, 'create']);
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');


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
    Route::get('/profile', function () {
        return "Halaman Profil Belum Dibuat. Nanti diganti dengan view ya min!";
    });
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    
    
    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::match(['post', 'put'], '/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    /*
    |--------------------------------------------------------------------------
    | add friend
    |--------------------------------------------------------------------------
    */
});