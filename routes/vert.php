<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vert\AdminInscriptionController;

Route::middleware('guest')->group(function () {
    //
});

Route::middleware('auth')->group(function () {
    //
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/inscriptions-en-attente', [AdminInscriptionController::class, 'showPending'])->name('vert.admin.inscriptions_en_attente');
    Route::put('/admin/inscriptions/update-multiple', [AdminInscriptionController::class, 'updateMultiple'])->name('vert.admin.inscriptions.updateMultiple');
    Route::delete('/admin/inscriptions/delete-multiple', [AdminInscriptionController::class, 'deleteMultiple'])->name('vert.admin.inscriptions.deleteMultiple');
});