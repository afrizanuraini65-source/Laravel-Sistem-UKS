<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\TreatmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Shared routes (Admin & Petugas)
    Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
    Route::resource('treatments', TreatmentController::class);

    // Admin only routes (Siswa, Kelas, Laporan, & Medicine CRUD)
    Route::middleware('is_admin')->group(function () {
        Route::resource('students', StudentController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('medicines', MedicineController::class)->except(['index']);
        Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
