<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InquilinoController;
use App\Http\Controllers\UtilizadorController;
use App\Http\Controllers\ImovelController;
use App\Http\Controllers\TipoContratoController;
use App\Http\Controllers\TipoDespesaController;
use App\Http\Controllers\TipoImovelController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\FotoController;
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

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::get('/dashboard', function () {
    if (in_array(auth()->user()->role, ['admin', 'proprietario'])) {
        return view('admin.index');
    }
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Utilizadores
    Route::get('/utilizadores', [UtilizadorController::class, 'index'])->name('utilizadores.index');
    Route::get('/utilizadores/{utilizador}/edit', [UtilizadorController::class, 'edit'])->name('utilizadores.edit');
    Route::put('/utilizadores/{utilizador}', [UtilizadorController::class, 'update'])->name('utilizadores.update');
    Route::delete('/utilizadores/{utilizador}', [UtilizadorController::class, 'destroy'])->name('utilizadores.destroy');
    Route::get('/utilizadores/create', [UtilizadorController::class, 'create'])->name('utilizadores.create');
    Route::post('/utilizadores', [UtilizadorController::class, 'store'])->name('utilizadores.store');
    Route::get('/utilizadores/{utilizador}', [UtilizadorController::class, 'show'])->name('utilizadores.show');

    // TipoContrato
    Route::get('/tipo_contrato/create', [TipoContratoController::class, 'create'])->name('tipo_contrato.create');
    Route::post('/tipo_contrato', [TipoContratoController::class, 'store'])->name('tipo_contrato.store');
    Route::get('/tipo_contrato/{tipo_contrato}/edit', [TipoContratoController::class, 'edit'])->name('tipo_contrato.edit');
    Route::put('/tipo_contrato/{tipo_contrato}', [TipoContratoController::class, 'update'])->name('tipo_contrato.update');
    Route::delete('/tipo_contrato/{tipo_contrato}', [TipoContratoController::class, 'destroy'])->name('tipo_contrato.destroy');

    // TipoImovel
    Route::get('/tipo_imovel', [TipoImovelController::class, 'index'])->name('tipo_imovel.index');
    Route::get('/tipo_imovel/create', [TipoImovelController::class, 'create'])->name('tipo_imovel.create');
    Route::post('/tipo_imovel', [TipoImovelController::class, 'store'])->name('tipo_imovel.store');
    Route::get('/tipo_imovel/{tipo_imovel}/edit', [TipoImovelController::class, 'edit'])->name('tipo_imovel.edit');
    Route::put('/tipo_imovel/{tipo_imovel}', [TipoImovelController::class, 'update'])->name('tipo_imovel.update');
    Route::delete('/tipo_imovel/{tipo_imovel}', [TipoImovelController::class, 'destroy'])->name('tipo_imovel.destroy');

    // TipoDespesa
    Route::get('/tipo_despesa/create', [TipoDespesaController::class, 'create'])->name('tipo_despesa.create');
    Route::post('/tipo_despesa', [TipoDespesaController::class, 'store'])->name('tipo_despesa.store');
    Route::get('/tipo_despesa/{tipo_despesa}/edit', [TipoDespesaController::class, 'edit'])->name('tipo_despesa.edit');
    Route::put('/tipo_despesa/{tipo_despesa}', [TipoDespesaController::class, 'update'])->name('tipo_despesa.update');
    Route::delete('/tipo_despesa/{tipo_despesa}', [TipoDespesaController::class, 'destroy'])->name('tipo_despesa.destroy');
});

Route::middleware(['auth', 'role:admin,proprietario'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/proprietario/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/proprietario/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/proprietario/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::post('/proprietario/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    // Inquilinos
    Route::get('/inquilinos', [InquilinoController::class, 'index'])->name('inquilinos.index');
    Route::get('/inquilinos/{inquilino}/edit', [InquilinoController::class, 'edit'])->name('inquilinos.edit');
    Route::put('/inquilinos/{inquilino}', [InquilinoController::class, 'update'])->name('inquilinos.update');
    Route::delete('/inquilinos/{inquilino}', [InquilinoController::class, 'destroy'])->name('inquilinos.destroy');
    Route::get('/inquilinos/create', [InquilinoController::class, 'create'])->name('inquilinos.create');
    Route::post('/inquilinos', [InquilinoController::class, 'store'])->name('inquilinos.store');
    Route::get('/inquilinos/{inquilino}', [InquilinoController::class, 'show'])->name('inquilinos.show');
    Route::get('/inquilinos/{inquilino}/contratos', [InquilinoController::class, 'contratos'])->name('inquilinos.contratos');

    // Imoveis
    Route::get('/imoveis', [ImovelController::class, 'index'])->name('imoveis.index');
    Route::get('/imoveis/{imovel}/edit', [ImovelController::class, 'edit'])->name('imoveis.edit');
    Route::put('/imoveis/{imovel}', [ImovelController::class, 'update'])->name('imoveis.update');
    Route::delete('/imoveis/{imovel}', [ImovelController::class, 'destroy'])->name('imoveis.destroy');
    Route::get('/imoveis/create', [ImovelController::class, 'create'])->name('imoveis.create');
    Route::post('/imoveis', [ImovelController::class, 'store'])->name('imoveis.store');
    Route::get('/imoveis/{imovel}', [ImovelController::class, 'show'])->name('imoveis.show');

    // TipoDespesa
    Route::get('/tipo_despesa', [TipoDespesaController::class, 'index'])->name('tipo_despesa.index');
    // TipoImovel
    Route::get('/tipo_imovel', [TipoImovelController::class, 'index'])->name('tipo_imovel.index');
    // TipoContrato
    Route::get('/tipo_contrato', [TipoContratoController::class, 'index'])->name('tipo_contrato.index');

    // Despesa
    Route::get('/despesa', [DespesaController::class, 'index'])->name('despesa.index');
    Route::get('/despesa/{despesa}/edit', [DespesaController::class, 'edit'])->name('despesa.edit');
    Route::put('/despesa/{despesa}', [DespesaController::class, 'update'])->name('despesa.update');
    Route::delete('/despesa/{despesa}', [DespesaController::class, 'destroy'])->name('despesa.destroy');
    Route::get('/despesa/create', [DespesaController::class, 'create'])->name('despesa.create');
    Route::post('/despesa', [DespesaController::class, 'store'])->name('despesa.store');
    Route::get('/despesa/{despesa}', [DespesaController::class, 'show'])->name('despesa.show');

    // Contrato
    Route::get('/contrato', [ContratoController::class, 'index'])->name('contrato.index');
    Route::get('/contrato/{contrato}/edit', [ContratoController::class, 'edit'])->name('contrato.edit');
    Route::put('/contrato/{contrato}', [ContratoController::class, 'update'])->name('contrato.update');
    Route::delete('/contrato/{contrato}', [ContratoController::class, 'destroy'])->name('contrato.destroy');
    Route::get('/contrato/create', [ContratoController::class, 'create'])->name('contrato.create');
    Route::post('/contrato', [ContratoController::class, 'store'])->name('contrato.store');
    Route::get('/contrato/{contrato}', [ContratoController::class, 'show'])->name('contrato.show');

    // Pagamento
    Route::get('/pagamento', [PagamentoController::class, 'index'])->name('pagamento.index');
    Route::get('/pagamento/{pagamento}/edit', [PagamentoController::class, 'edit'])->name('pagamento.edit');
    Route::put('/pagamento/{pagamento}', [PagamentoController::class, 'update'])->name('pagamento.update');
    Route::delete('/pagamento/{pagamento}', [PagamentoController::class, 'destroy'])->name('pagamento.destroy');
    Route::get('/pagamento/create', [PagamentoController::class, 'create'])->name('pagamento.create');
    Route::post('/pagamento', [PagamentoController::class, 'store'])->name('pagamento.store');
    Route::get('/pagamento/{pagamento}', [PagamentoController::class, 'show'])->name('pagamento.show');
    Route::post('/pagamento/{id}/emitir-fatura', [PagamentoController::class, 'emitirFatura'])->name('pagamento.emitirFatura');
    // Foto
    Route::resource('foto', FotoController::class);
});

Route::get('/admin/login', function () {
    return redirect()->route('login');
})->name('admin.login');
