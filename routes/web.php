<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Models\Cliente;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes', [ClientesController::class, 'listar']);
Route::get('/clientes/novo', [ClientesController::class, 'novo'])->name('cliente.novo');
Route::post('/clientes/novo/{id?}', [ClientesController::class, 'salvar'])->name('cliente.salvar');
Route::get('/clientes/edit/{id}', [ClientesController::class, 'edit'])->name('cliente.edit');
Route::get('/clientes/delete/{id}', [ClientesController::class, 'delete'])->name('cliente.delete');


