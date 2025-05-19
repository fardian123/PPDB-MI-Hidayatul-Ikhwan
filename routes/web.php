<?php

use App\Http\Controllers\petugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\PendaftaranController;

// Halaman depan (public)
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
});

// ============================
// ROUTE SETELAH LOGIN (auth)
// ============================
Route::middleware('auth')->group(function () {

    // OTP Two-Factor (verifikasi setelah login)
    Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index');
    Route::post('/two-factor/send', [TwoFactorController::class, 'send'])->name('two-factor.send');
    Route::post('/two-factor', [TwoFactorController::class, 'verify'])->name('two-factor.verify');

});

// ============================
// ROUTE SETELAH OTP VERIFIED
// ============================
Route::middleware(['auth', 'otpVerified', 'role:user'])->group(function () {

    Route::get('/dashboard', function () {
        return view('user.user_index');
    })->name('user.dashboard');



    Route::get('/user/hasil-seleksi', [userController::class, 'userHasilSeleksi'])->name('user.hasil-seleksi');
    Route::get('/user/pendaftaran', [userController::class, 'userPendaftaran'])->name('user.pendaftaran');
    Route::get('/user/profile', [userController::class, 'userProfile'])->name('user.profile');
    Route::get('/user/change/password', [userController::class, 'userChangePassword'])->name('user.change.password');




    Route::post('/user/pendaftaran/store', [PendaftaranController::class, 'PendaftaranStore'])->name('user.pendaftaran.store');
    Route::post('/user/pendaftaran/update', [PendaftaranController::class, 'PendaftaranUpdate'])->name('user.pendaftaran.update');
    Route::post('/user/pendaftaran/delete', [PendaftaranController::class, 'PendaftaranDelete'])->name('user.pendaftaran.delete');

    Route::post('/user/profile/store', [userController::class, 'userProfileStore'])->name('user.profile.store');
    Route::POST('/user/password/update', [userController::class, 'userPasswordUpdate'])->name('user.password.update');

    Route::get('user/formulir/download', [PendaftaranController::class, 'pendaftaranDownload'])->name('user.formulir.download');


});


Route::middleware(['auth', 'otpVerified', 'role:petugas'])->group(function () {

    Route::get('/petugas/dashboard', [petugasController::class, 'petugasDashboard'] )->name('petugas.dashboard');

    Route::get('/petugas/master-peserta-didik', [petugasController::class, 'petugasMasterPesertaDidik'])->name('petugas.master_peserta_didik');



    Route::get('/petugas/profile', [petugasController::class, 'petugasProfile'])->name('petugas.profile');
    Route::post('/petugas/profile/store', [petugasController::class, 'petugasProfileStore'])->name('petugas.profile.store');
    Route::get('/petugas/change/password', [petugasController::class, 'petugasChangePassword'])->name('petugas.change.password');
    Route::POST('/petugas/password/update', [petugasController::class, 'petugasPasswordUpdate'])->name('petugas.password.update');

    Route::post('/petugas/pendaftaran/update-status/{id}', [petugasController::class, 'petugasUpdateStatus'])->name('petugas.update.status');
    Route::post('/petugas/pendaftaran/update-pendaftaran/{id}', [petugasController::class, 'petugasUpdatePendaftaran'])->name('petugas.update.pendaftaran');
    Route::post('/petugas/pendaftaran/hapus/', [PetugasController::class, 'petugasHapusPendaftaran'])->name('petugas.hapus.pendaftaran');
    
    Route::post('/petugas/pendaftaran/store', [petugasController::class, 'petugasStore'])->name('petugas.store.pendaftaran');
    


});
// Load auth routes (register, login, dsb.)
require __DIR__ . '/auth.php';
