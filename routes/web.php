<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DataPokokImportController;
use App\Http\Controllers\ImportController;
use Filament\Actions\CreateAction;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('files', FileController::class);
Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');

Route::post('/data-pokoks/import', [DataPokokImportController::class, 'store'])->name('data_pokoks.import');
Route::get('/data-pokoks/import', function () {
    return view('data_pokoks.import');
})->name('data_pokoks.import.form');
Route::post('/data-pokoks/store', [DataPokokImportController::class, 'store'])->name('data-pokoks.store');

Route::get('/import-progress', [ImportController::class, 'progress']);

Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');

Route::get('/admin/files', [FileController::class, 'index'])->name('admin.files');


require __DIR__ . '/auth.php';
