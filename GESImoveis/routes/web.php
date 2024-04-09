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
    Route::get('/utilizadores/{utilizador}', [UtilizadorController::class, 'show'])->name('utilizadores.show');
});

Route::middleware(['auth', 'role:admin,proprietario'])->group(function () {
    // Inquilinos
    Route::get('/inquilinos', [InquilinoController::class, 'index'])->name('inquilinos.index');
    Route::get('/inquilinos/{inquilino}/edit', [InquilinoController::class, 'edit'])->name('inquilinos.edit');
    Route::put('/inquilinos/{inquilino}', [InquilinoController::class, 'update'])->name('inquilinos.update');
    Route::delete('/inquilinos/{inquilino}', [InquilinoController::class, 'destroy'])->name('inquilinos.destroy');
    Route::get('/inquilinos/create', [InquilinoController::class, 'create'])->name('inquilinos.create');
    Route::post('/inquilinos', [InquilinoController::class, 'store'])->name('inquilinos.store');
    Route::get('/inquilinos/{inquilino}', [InquilinoController::class, 'show'])->name('inquilinos.show');

    // Imoveis
    Route::get('/imoveis', [ImovelController::class, 'index'])->name('imoveis.index');
    Route::get('/imoveis/{imovel}/edit', [ImovelController::class, 'edit'])->name('imoveis.edit');
    Route::put('/imoveis/{imovel}', [ImovelController::class, 'update'])->name('imoveis.update');
    Route::delete('/imoveis/{imovel}', [ImovelController::class, 'destroy'])->name('imoveis.destroy');
    Route::get('/imoveis/create', [ImovelController::class, 'create'])->name('imoveis.create');
    Route::post('/imoveis', [ImovelController::class, 'store'])->name('imoveis.store');
    Route::get('/imoveis/{imovel}', [ImovelController::class, 'show'])->name('imoveis.show');
});

Route::get('/admin/login', function () {
    return redirect()->route('login');
})->name('admin.login');
