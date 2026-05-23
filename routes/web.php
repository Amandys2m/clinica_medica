<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EspecialidadesController;
use App\Models\Cliente;
use App\Models\Especialidade;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes', [ClientesController::class, 'listar']);
Route::get('/clientes/novo', [ClientesController::class, 'novo'])->name('cliente.novo');
Route::post('/clientes/novo/{id?}', [ClientesController::class, 'salvar'])->name('cliente.salvar');
Route::get('/clientes/edit/{id}', [ClientesController::class, 'edit'])->name('cliente.edit');
Route::get('/clientes/delete/{id}', [ClientesController::class, 'delete'])->name('cliente.delete');

Route::get('/especialidades', [EspecialidadesController::class, 'listar']);
Route::get('/especialidades/nova', [EspecialidadesController::class, 'nova'])->name('especialidade.nova');
Route::post('/especialidades/nova/{id?}', [EspecialidadesController::class, 'salvar'])->name('especialidade.salvar');
Route::get('/especialidades/editar/{id}', [EspecialidadesController::class, 'editar'])->name('especialidade.editar');
Route::get('/especialidades/delete/{id}', [EspecialidadesController::class, 'delete'])->name('especialidade.delete');