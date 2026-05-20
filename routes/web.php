<?php

use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('candidatures.index');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/candidatures', [CandidatureController::class, 'index'])
        ->name('candidatures.index');
    Route::get('/candidatures/create', [CandidatureController::class, 'create'])
        ->name('candidatures.create');
    Route::post('/candidatures', [CandidatureController::class, 'store'])
        ->name('candidatures.store');
    Route::get('/candidatures/archives', [CandidatureController::class, 'archived'])
        ->name('candidatures.archived');
    Route::get('/candidatures/{candidature}', [CandidatureController::class, 'show'])
        ->name('candidatures.show')
        ->withTrashed();
    Route::get('/candidatures/{candidature}/edit', [CandidatureController::class, 'edit'])
        ->name('candidatures.edit');
    Route::match(['put', 'patch'], '/candidatures/{candidature}', [CandidatureController::class, 'update'])
        ->name('candidatures.update');
    Route::delete('/candidatures/{candidature}', [CandidatureController::class, 'destroy'])
        ->name('candidatures.archive');
    Route::post('/candidatures/{candidature}/restore', [CandidatureController::class, 'restore'])
        ->name('candidatures.restore')
        ->withTrashed();

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
