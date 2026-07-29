<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\RegisterController;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('pinjam.public', [
        'title' => 'Home',
        'peminjaman' => Peminjaman::with(['barang', 'user'])->latest()->get(),
        'barangs' => Barang::where('stok', '>', 0)->get(),
    ]);
})->middleware('guest');

Route::get('/pinjam/form', [PinjamController::class, 'create'])->name('pinjam.create');
Route::post('/pinjam/store', [PinjamController::class, 'store'])->name('pinjam.store');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'store']);
    Route::get('/dashboard/print', [DashboardController::class, 'print'])->name('dashboard.print');
    Route::get('/dashboard/{id}', [DashboardController::class, 'show']);
    Route::get('/dashboard/{id}/edit', [DashboardController::class, 'edit']);
    Route::put('/dashboard/{id}', [DashboardController::class, 'update']);
    Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy']);

    Route::get('/pinjam', [PinjamController::class, 'index'])->name('pinjam.index');
    Route::get('/pinjam/{pinjam}', [PinjamController::class, 'show'])->name('pinjam.show');
    Route::patch('/pinjam/{pinjam}/status', [PinjamController::class, 'updateStatus'])->name('pinjam.update-status');
    Route::post('/pinjam/{pinjam}/return', [PinjamController::class, 'return'])->name('pinjam.return');
    Route::delete('/pinjam/{pinjam}', [PinjamController::class, 'destroy'])->name('pinjam.destroy');
});
