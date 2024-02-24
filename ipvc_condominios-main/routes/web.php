<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UtilizadoresController;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [AuthController::class, 'dashboard']); 

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'confirmarLogin'])->name('confirmarLogin'); 

Route::get('registration', [AuthController::class, 'registro'])->name('registro');
Route::post('registration', [AuthController::class, 'confirmarRegistro'])->name('confirmarRegistro'); 

Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

Route::get('forgot-password', [AuthController::class, 'esquecerPw'])->name('password.request');
Route::post('forgot-password', [AuthController::class, 'confirmarEsquecerPw'])->name('password.email');

Route::get('reset-password/{token}', [AuthController::class, 'resetPw'])->name('password.reset');
Route::post('reset-password',[AuthController::class, 'confirmarResetPw'])->name('password.update');


Route::get('novo', [UtilizadoresController::class, 'adminNewUser'])->name('adminNewUser');
Route::post('novo', [UtilizadoresController::class, 'confirmarNovoUtilizador'])->name('confirmarNovoUtilizador');

Route::get('editar/{id}', [UtilizadoresController::class, 'adminEditarUser'])->name('adminEditarUser');
Route::post('editar', [UtilizadoresController::class, 'confirmarEditarUser'])->name('confirmarEditarUser');

Route::get('habitacoes', [UtilizadoresController::class, 'habitacoes'])->name('habitacoes');
Route::get('novaHabitacao', [UtilizadoresController::class, 'novaHabitacao'])->name('novaHabitacao');
Route::post('novaHabitacao', [UtilizadoresController::class, 'confirmarNovaHabitacao'])->name('confirmarNovaHabitacao');
Route::get('editarHabitacao/{id}', [UtilizadoresController::class, 'editarHabitacao'])->name('editarHabitacao');
Route::post('editarHabitacao/{id}', [UtilizadoresController::class, 'confirmarEditarHabitacao'])->name('confirmarEditarHabitacao');

Route::get('novoCondominio', [UtilizadoresController::class, 'novoCondominio'])->name('novaHabitacao');
Route::post('novoCondominio', [UtilizadoresController::class, 'confirmarNovoCondominio'])->name('confirmarNovoCondominio');

Route::get('proprietarios', [UtilizadoresController::class, 'proprietarios'])->name('proprietarios');

Route::get('despesas', [UtilizadoresController::class, 'despesas'])->name('despesas');
Route::get('novaDespesa', [UtilizadoresController::class, 'novaDespesa'])->name('novaDespesa');
Route::post('novaDespesa', [UtilizadoresController::class, 'confirmarNovaDespesa'])->name('confirmarNovaDespesa');
Route::get('editarDespesa/{id}', [UtilizadoresController::class, 'editarDespesa'])->name('editarDespesa');
Route::post('editarDespesa/{id}', [UtilizadoresController::class, 'confirmarEditarDespesa'])->name('confirmarEditarDespesa');

Route::get('atas', [UtilizadoresController::class, 'atas'])->name('atas');
Route::get('novaAta', [UtilizadoresController::class, 'novaAta'])->name('novaAta');
Route::post('novaAta', [UtilizadoresController::class, 'confirmarNovaAta'])->name('confirmarNovaAta');
Route::get('editarAta/{id}', [UtilizadoresController::class, 'editarAta'])->name('editarAta');
Route::post('editarAta/{id}', [UtilizadoresController::class, 'confirmarEditarAta'])->name('confirmarEditarAta');

Route::get('pagamentos/{id}', [UtilizadoresController::class, 'pagamentos'])->name('pagamentos');
Route::get('novoPagamento', [UtilizadoresController::class, 'novoPagamento'])->name('novoPagamento');
Route::post('novoPagamento', [UtilizadoresController::class, 'confirmarNovoPagamento'])->name('confirmarNovoPagamento');

Route::get('verPagamentos/{id}', [UtilizadoresController::class, 'verPagamentos'])->name('verPagamentos');

Route::post('confirmarSelecionarCondominio', [UtilizadoresController::class, 'confirmarSelecionarCondominio'])->name('confirmarSelecionarCondominio'); 

Route::get('pagar/{id}', [UtilizadoresController::class, 'pagar'])->name('pagar');

//api datatables
Route::get('api/admins', [ApiController::class, 'admins'])->name('admins');
Route::get('api/admins_cond', [ApiController::class, 'admins_cond'])->name('admins_cond');
Route::get('api/props', [ApiController::class, 'props'])->name('props');

Route::get('api/minhas_habitacoes', [ApiController::class, 'minhas_habitacoes'])->name('minhas_habitacoes');

Route::get('api/proprietario/{cc}', [ApiController::class, 'proprietario']);

Route::post('api/novaHabitacao', [ApiController::class, 'novaHabitacao'])->name('novaHabitacao');

Route::get('api/meus_proprietarios', [ApiController::class, 'meus_proprietarios'])->name('meus_proprietarios');

Route::get('api/minhas_despesas/{estado}', [ApiController::class, 'minhas_despesas'])->name('minhas_despesas');
Route::post('api/atualizarEstadoDespesa', [ApiController::class, 'atualizarEstadoDespesa'])->name('atualizarEstadoDespesa');

Route::get('api/minhas_atas', [ApiController::class, 'minhas_atas'])->name('minhas_atas');

Route::post('api/apagarDespesa', [ApiController::class, 'apagarDespesa'])->name('apagarDespesa');
Route::get('api/ata/{id}', [ApiController::class, 'ata'])->name('ata');

Route::get('api/pagamentos/{estado}', [ApiController::class, 'pagamentos'])->name('pagamentos');
Route::post('api/atualizarEstadoPagamento', [ApiController::class, 'atualizarEstadoPagamento'])->name('atualizarEstadoPagamento');
Route::post('api/apagarPagamento', [ApiController::class, 'apagarPagamento'])->name('apagarPagamento');

Route::get('api/habitacoes_users/{id}', [ApiController::class, 'habitacoes_users'])->name('habitacoes_users');

Route::get('api/minhas_habitacoes_prop', [ApiController::class, 'minhas_habitacoes_prop'])->name('minhas_habitacoes_prop');

Route::get('api/pagamentos_user/{id}/{estado}', [ApiController::class, 'pagamentos_user'])->name('pagamentos_user');
