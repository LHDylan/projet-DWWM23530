<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Orange\QuizController;
use App\Http\Controllers\Orange\JouerController;
use App\Http\Controllers\Orange\AccueilController;
use App\Http\Controllers\Orange\ReponseController;
use App\Http\Controllers\Orange\QuestionController;
use App\Http\Controllers\Orange\CategorieController;

Route::middleware('guest')->group(function () {
    //
});

Route::middleware('auth')->group(function () {
    Route::get('/quiz', [AccueilController::class, 'index'])->name('accueil.index');
    Route::get('/jouer', [JouerController::class, 'index'])->name('jouer.index');
    Route::post('/jouer', [JouerController::class, 'play'])->name('jouer.play');
    Route::post('/jouer/next', [JouerController::class, 'play_next'])->name('jouer_next.play');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/quiz/admin', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('/quiz/admin/{id}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
    Route::put('/quiz/admin/{id}', [QuizController::class, 'update'])->name('quiz.update');
    Route::delete('/quiz/admin/{id}', [QuizController::class, 'destroy'])->name('quiz.destroy');
    Route::get('/quiz/admin/create', [QuizController::class, 'create'])->name('quiz.create');
    Route::get('/quiz/admin/{id}/cancel', [QuizController::class, 'cancel'])->name('quiz.cancel');
    Route::post('/quiz/admin', [QuizController::class, 'store'])->name('quiz.store');
    Route::get('/quiz/admin/association', [QuizController::class, 'association'])->name('quiz.association');
    Route::get('/quiz/admin/association/{id}', [QuizController::class, 'association'])->name('quiz.association.edit');
    // Route::put('/quiz/admin/association', [QuizController::class, 'association_update'])->name('quiz.association.update');
    
    Route::resource('categorie', CategorieController::class);
    Route::get('/categorie/admin/create', [CategorieController::class, 'create'])->name('categorie.create');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categorie.store');
    Route::put('/categorie/admin/update', [CategorieController::class, 'update'])->name('categorie.update');
    
    // Route::get('/reponse/admin', [ReponseController::class, 'index'])->name('reponse.index');
    Route::put('/reponse/admin/association_update', [ReponseController::class, 'association_update'])->name('reponse.association_update');
    Route::get('/reponse/admin/create', [ReponseController::class, 'create'])->name('reponse.create');
    Route::post('/reponses', [ReponseController::class, 'store'])->name('reponse.store');
    Route::put('/reponse/admin/{id}', [ReponseController::class, 'update'])->name('reponse.update');
    Route::get('/reponse/admin/{id}/edit', [ReponseController::class, 'edit'])->name('reponse.edit');
    Route::delete('/reponse/admin/{id}', [ReponseController::class, 'destroy'])->name('reponse.destroy');
    
    // Route::get('/question/admin', [QuestionController::class, 'index'])->name('question.index');
    Route::get('/question/admin/create', [QuestionController::class, 'create'])->name('question.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('question.store');
    Route::put('/qestion/admin/{id}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('/question/admin/{id}', [QuestionController::class, 'destroy'])->name('question.destroy');
    Route::get('/question/admin/{id}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('/question/admin/association_update', [QuestionController::class, 'association_update'])->name('question.association_update');
    Route::get('/question/admin/association', [QuestionController::class, 'association'])->name('question.association');
    Route::get('/question/admin/association/{id}', [QuestionController::class, 'association'])->name('question.association.edit');
});