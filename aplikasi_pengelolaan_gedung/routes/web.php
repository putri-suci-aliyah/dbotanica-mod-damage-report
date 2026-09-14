<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerbaikanGedungController;
use App\Http\Controllers\PerbaikanPengerjaanGedungController;
use App\Http\Controllers\SelesaiPengerjaanGedungController; 
use App\Http\Controllers\GenerateExcelController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\BackupController;

Route::get('login', [LoginController::class, 'index']);
Route::get('/', [LoginController::class, 'index']);

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::resource('dashboard', DashboardController::class);

    Route::resource('divisi', DivisiController::class);
    Route::put('divisi/soft_delete_divisi/{id}', [DivisiController::class, 'soft_delete_divisi']);
    Route::resource('users', UserController::class);
    Route::put('users/soft_delete_users/{id}', [UserController::class, 'soft_delete_users']);

    Route::post('perbaikan/upload', [PerbaikanGedungController::class, 'upload'])->name('perbaikan.upload');
    Route::resource('perbaikan', PerbaikanGedungController::class);
    Route::put('perbaikan/mulai_pengerjaan/{id}', [PerbaikanGedungController::class, 'mulai_pengerjaan']);
    Route::get('/perbaikan/{perbaikanGedung}/show', [PerbaikanGedungController::class, 'show'])->name('perbaikan.show');

    Route::resource('pengerjaan_perbaikan', PerbaikanPengerjaanGedungController::class);
    Route::put('pengerjaan_perbaikan/selesai_pengerjaan/{id}', [PerbaikanPengerjaanGedungController::class, 'selesai_pengerjaan']);
    Route::post('pengerjaan_perbaikan/upload', [PerbaikanPengerjaanGedungController::class, 'upload'])->name('pengerjaan_perbaikan.upload');

    Route::resource('selesai_perbaikan', SelesaiPengerjaanGedungController::class);
    Route::get('/selesai_perbaikan/{perbaikanGedung}/show', [SelesaiPengerjaanGedungController::class, 'show'])->name('selesai_perbaikan.show');

    Route::get('export_excel', [GenerateExcelController::class, 'export'])->name('export_excel');

    Route::resource('profile', MyProfileController::class);

    Route::get('/backup-db', [BackupController::class, 'backup'])->name('backup.db');
});
