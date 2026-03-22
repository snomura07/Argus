<?php

use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\AssigneeController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/masters/artifacts');
Route::redirect('/artifacts', '/masters/artifacts');

Route::prefix('masters')->name('masters.')->group(function (): void {
    Route::get('/artifacts', [ArtifactController::class, 'index'])->name('artifacts.index');
    Route::get('/artifacts/create', [ArtifactController::class, 'create'])->name('artifacts.create');
    Route::post('/artifacts', [ArtifactController::class, 'store'])->name('artifacts.store');
    Route::delete('/artifacts/{artifactId}', [ArtifactController::class, 'destroy'])->name('artifacts.destroy');

    Route::get('/assignees', [AssigneeController::class, 'index'])->name('assignees.index');
    Route::get('/assignees/create', [AssigneeController::class, 'create'])->name('assignees.create');
    Route::post('/assignees', [AssigneeController::class, 'store'])->name('assignees.store');
    Route::get('/assignees/{assigneeId}/edit', [AssigneeController::class, 'edit'])->name('assignees.edit');
    Route::put('/assignees/{assigneeId}', [AssigneeController::class, 'update'])->name('assignees.update');
});
