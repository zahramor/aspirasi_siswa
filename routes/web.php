<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| HALAMAN SISWA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [AspirasiController::class, 'index'])->name('dashboard');

    Route::post('/aspirasi', [AspirasiController::class, 'store']);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

});


/*
|--------------------------------------------------------------------------
| HALAMAN ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('is_admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/cetak-pdf', [AdminController::class, 'cetakPDF'])->name('admin.cetak');

    Route::post('/tanggapan/{id_pelaporan}', [AdminController::class, 'berikanTanggapan']);

    Route::get('/siswa', [AdminController::class, 'dataSiswa'])->name('admin.siswa');

    Route::delete('/siswa/{nis}', [AdminController::class, 'hapusSiswa'])->name('admin.siswa.hapus');

    Route::get('/logout', function () {
        session()->forget(['role','user_data']);
        return redirect('/login');
    })->name('admin.logout');

});