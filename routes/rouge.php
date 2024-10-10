<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rouge\FluxController;

Route::middleware('guest')->group(function () {
    // 
});

Route::middleware('auth')->group(function () {
    Route::get('actu',[FluxController::class, 'afficherFlux'])->name('actu.index');
    Route::get('actu/{nom_flux}',[FluxController::class, 'afficherFlux'])->name('actu.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('rouge.backOffice.tableauDeBord');
    })->name('admin');
    Route::get('/admin/actu', [FluxController::class, 'index'])->name('admin.actu.index');
    Route::get('/admin/actu/create',[FluxController::class, 'create'])->name('admin.actu.create');
    Route::post('/admin/actu/create',[FluxController::class, 'store'])->name('admin.actu.store');
    Route::get('/admin/actu/edit/{id}',[FluxController::class, 'edit'])->name('admin.actu.edit');
    Route::put('/admin/actu/{id}', [FluxController::class, 'update'])->name('admin.actu.update');
    Route::delete('/admin/actu/{id}' ,[FluxController::class, 'destroy'])->name('admin.actu.destroy');
});