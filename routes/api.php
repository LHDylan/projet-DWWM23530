<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rouge\FluxController;

Route::middleware('guest')->group(function () {
    Route::get('/actu/{nom_flux}',[FluxController::class, 'apiFlux'])->name('api.apiFlux');
    Route::get('/actu',[FluxController::class, 'apiFlux'])->name('api.apiFlux');
});