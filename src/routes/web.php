<?php

use App\Http\Controllers\ArtifactController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/artifacts');

Route::get('/artifacts', [ArtifactController::class, 'index'])->name('artifacts.index');
Route::get('/artifacts/create', [ArtifactController::class, 'create'])->name('artifacts.create');
Route::post('/artifacts', [ArtifactController::class, 'store'])->name('artifacts.store');
