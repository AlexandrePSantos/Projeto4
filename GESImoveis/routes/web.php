<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InquilinoController;
use App\Http\Controllers\UtilizadorController;
use App\Http\Controllers\ImovelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    // Route::resource('/utilizadores', UtilizadorController::class);
    // Utilizadores
    Route::get('/utilizadores', [UtilizadorController::class, 'index'])->name('utilizadores.index');
    Route::get('/utilizadores/{utilizador}/edit', [UtilizadorController::class, 'edit'])->name('utilizadores.edit');
    Route::put('/utilizadores/{utilizador}', [UtilizadorController::class, 'update'])->name('utilizadores.update');
    Route::delete('/utilizadores/{utilizador}', [UtilizadorController::class, 'destroy'])->name('utilizadores.destroy');
    Route::get('/utilizadores/create', [UtilizadorController::class, 'create'])->name('utilizadores.create');
    Route::post('/utilizadores', [UtilizadorController::class, 'store'])->name('utilizadores.store');

    Route::resource('/inquilinos', InquilinoController::class);
    Route::resource('/imoveis', ImovelController::class);
});

Route::get('/admin/login', function () {
    return redirect()->route('login');
})->name('admin.login');
