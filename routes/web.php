<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\ConveniosController;
use App\Http\Controllers\ProfissionaisController;
use App\Models\Especialidade;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConfiguracaoController;


Route::get('/', function () {
    $especialidades = Especialidade::all();
    return view('welcome', compact('especialidades'));
})->name('home');


Route::get('/clientes/novo', [ClientesController::class, 'novo'])->name('cliente.novo');
Route::post('/clientes/novo/{id?}', [ClientesController::class, 'salvar'])->name('cliente.salvar');

Route::middleware(['auth','is_admin'])->group(function () {
Route::get('/clientes', [ClientesController::class, 'listar']);
Route::get('/clientes/edit/{id}', [ClientesController::class, 'edit'])->name('cliente.edit');
Route::get('/clientes/delete/{id}', [ClientesController::class, 'delete'])->name('cliente.delete');

Route::get('/especialidades', [EspecialidadesController::class, 'listar']);
Route::get('/especialidades/nova', [EspecialidadesController::class, 'nova'])->name('especialidade.nova');
Route::post('/especialidades/nova/{id?}', [EspecialidadesController::class, 'salvar'])->name('especialidade.salvar');
Route::get('/especialidades/editar/{id}', [EspecialidadesController::class, 'editar'])->name('especialidade.editar');
Route::get('/especialidades/delete/{id}', [EspecialidadesController::class, 'delete'])->name('especialidade.delete');

Route::get('/convenios', [ConveniosController::class, 'listar']);
Route::get('/convenios/novo', [ConveniosController::class, 'novo'])->name('convenio.novo');
Route::post('/convenios/novo/{id?}', [ConveniosController::class, 'salvar'])->name('convenio.salvar');
Route::get('/convenios/editar/{id}', [ConveniosController::class, 'editar'])->name('convenio.editar');
Route::get('/convenios/delete/{id}', [ConveniosController::class, 'delete'])->name('convenio.delete');

Route::get('/profissionais', [ProfissionaisController::class, 'listar']);
Route::get('/profissionais/novo', [ProfissionaisController::class, 'novo'])->name('profissional.novo');
Route::post('/profissionais/novo/{id?}', [ProfissionaisController::class, 'salvar'])->name('profissional.salvar');
Route::get('/profissionais/editar/{id}', [ProfissionaisController::class, 'editar'])->name('profissional.editar');
Route::get('/profissionais/delete/{id}', [ProfissionaisController::class, 'delete'])->name('profissional.delete');

Route::get('/agendamentos', [AgendamentoController::class, 'listar']);
Route::get('/agendamentos/editar/{id}', [AgendamentoController::class, 'editar'])->name('agendamento.editar');
Route::get('/agendamentos/delete/{id}', [AgendamentoController::class, 'delete'])->name('agendamento.delete');
});
Route::middleware(['auth'])->group(function () {
Route::get('/agendamentos/novo', [AgendamentoController::class, 'novo'])->name('agendamento.novo');
Route::post('/agendamentos/salvar', [AgendamentoController::class, 'salvar'])->name('agendamento.salvar');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/configuracoes', [ConfiguracaoController::class, 'index'])->name('configuracoes.index');
Route::post('/configuracoes', [ConfiguracaoController::class, 'salvar'])->name('configuracoes.salvar');
});
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');