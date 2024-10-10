<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bleu\Client\ArticleController;
use App\Http\Controllers\Bleu\Client\CommentController;
use App\Http\Controllers\Bleu\Admin\AdminArticleController;
use App\Http\Controllers\Bleu\Admin\AdminCommentController;
use App\Http\Controllers\Bleu\Admin\AdminTagController;

Route::middleware('guest')->group(function () {
    //
});

Route::middleware('auth')->group(function () {

    /**
     * Routes to access client comments as guest user (index, show)
     * Routes to access client articles as authenticated user (create, store, edit, update, destroy)
     */
    Route::get('/articles', [ArticleController::class, 'index'])->name('bleu.client.articles.index');
    Route::get('/articles/ajout-article', [ArticleController::class, 'create'])->name('bleu.client.articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('bleu.client.articles.store');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('bleu.client.articles.show');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('bleu.client.articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('bleu.client.articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('bleu.client.articles.destroy');

    /**
     * Routes to access client comments as authenticated user
     */
    Route::prefix('/comments')->name('bleu.client.comments.')->group(function () {
        Route::put('/{comment}', [CommentController::class, 'update'])->name('update');
        Route::post('/', [CommentController::class, 'store'])->name('store');
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware(['auth', 'admin'])->group(function () {

    /**
     * Route to access the admin dashboard
     */
    Route::get('/bleu/dashboard', function () {
        return view('bleu.admin.dashboard');
    })->name('bleu.dashboard');

    /**
     * Routes to access admin tags
     */
    Route::prefix('bleu/admin/tags')->name('bleu.admin.tags.')->group(function () {
        Route::get('/', [AdminTagController::class, 'index'])->name('index');
        Route::post('/', [AdminTagController::class, 'store'])->name('store');
        Route::put('/{tag}', [AdminTagController::class, 'update'])->name('update');
        Route::delete('/{tag}', [AdminTagController::class, 'destroy'])->name('destroy');
        Route::patch('/{tag}', [AdminTagController::class, 'restore'])->name('restore');
    });

    /**
     * Routes to access admin articles
     */
    Route::prefix('bleu/admin/articles')->name('bleu.admin.articles.')->group(function () {
        Route::get('/', [AdminArticleController::class, 'indexVisibleWithoutTrashed'])->name('index');
        Route::get('/pending', [AdminArticleController::class, 'indexPendingValidation'])->name('pending');
        Route::get('/trashed', [AdminArticleController::class, 'indexOnlyTrashed'])->name('trashed');
        Route::get('/{article}', [AdminArticleController::class, 'editVisibility'])->name('editVisibility');
        Route::put('/{article}', [AdminArticleController::class, 'update'])->name('update');
        Route::delete('/{article}', [AdminArticleController::class, 'destroy'])->name('destroy');
        Route::patch('/{article}', [AdminArticleController::class, 'restore'])->name('restore');
    });

    /**
     * Routes to access admin comments
     */
    Route::prefix('bleu/admin/comments')->name('bleu.admin.comments.')->group(function () {
        Route::get('/', [AdminCommentController::class, 'indexWithoutTrashed'])->name('index');
        Route::get('/trashed', [AdminCommentController::class, 'indexOnlyTrashed'])->name('trashed');
        Route::delete('{comment}', [AdminCommentController::class, 'destroy'])->name('destroy');
        Route::patch('{comment}', [AdminCommentController::class, 'restore'])->name('restore');
    });
});