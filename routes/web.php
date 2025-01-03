<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ChirpController;
use App\Models\Chirp;

use App\Http\Controllers\PlantController;
use App\Http\Controllers\DashboardController;
use App\Models\Plant;

Route::get('/', function () {
    return view('welcome');
});

/** DASHBOARD */
Route::get('/dashboard', function () {

    $chirps = Chirp::with('user')->latest()->get();
    $batches = \App\Models\Plant::select('batch_number', 'name')
        ->selectRaw('COUNT(*) as total_plants')
        ->selectRaw('SUM(CASE WHEN archived = 0 THEN 1 ELSE 0 END) as active_plants')
        ->groupBy('batch_number')
        ->get();
    $notExportedCount = \App\Models\Plant::where('is_exported', false)->count();

    return view('dashboard', compact('chirps', 'batches', 'notExportedCount'));

})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');


/** Profile  */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/** Chirps */
Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

/** PLANT */
use App\Http\Controllers\NoteController;
Route::resource('plants', PlantController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);;

Route::get('/plants/archive', [PlantController::class, 'archiveList'])->name('plants.archive.list');

Route::get('/plants/create', [PlantController::class, 'create'])->name('plants.create');

Route::get('/plants/export', [PlantController::class, 'showExportPage'])->name('plants.export');
Route::post('/plants/export', [PlantController::class, 'exportSelectedPlants'])->name('plants.export.submit');

Route::get('/plants/review-export', [PlantController::class, 'showReviewPage'])->name('plants.review');
Route::post('/plants/review-export', [PlantController::class, 'addToExport'])->name('plants.review.submit');

Route::get('/plants/{plant}', [PlantController::class, 'show'])->name('plants.show');
Route::patch('/plants/{plant}/archive', [PlantController::class, 'archive'])->name('plants.archive');
Route::post('/plants/{plant}/notes', [NoteController::class, 'store'])->name('notes.store');
Route::patch('/plants/{plant}/restore', [PlantController::class, 'restore'])->name('plants.restore');

Route::get('/plants/batch/{batchNumber}', [PlantController::class, 'showBatch'])->name('plants.batch');
Route::patch('/plants/batch/{batchNumber}/archive', [PlantController::class, 'archiveBatch'])->name('plants.batch.archive');
Route::patch('/plants/batch/{batchNumber}/restore', [PlantController::class, 'restoreBatch'])->name('plants.batch.restore');

require __DIR__.'/auth.php';
