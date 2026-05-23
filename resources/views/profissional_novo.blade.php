@extends('main')

@section('titulo', 'Novo Profissional')

@section('conteudo')
<h1>Novo Profissional</h1>
<form method="POST" action="{{ route('profissional.salvar') }}">
    @csrf
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome">
    <label for="nome">Nome</label>
    </div>
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="cpf" placeholder="CPF" name="cpf">
    <label for="cpf">CPF</label>
    </div>
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="rg" placeholder="RG" name="rg">
    <label for="rg">RG</label>
    </div>
    <div class="form-floating mb-3">
    <input type="date" class="form-control" id="data_nasc" placeholder="Data Nascimento" name="data_nasc">
    <label for="data_nasc">Data de Nascimento</label>
    </div>

    
    <div class="mb-3">
    <label class="form-label">Especialidade</label>
    <select name="especialidade" class="form-select">
    <option value="">Selecione uma especialidade</option>
    @foreach($especialidades as $e)
    <option value="{{ $e->id }}">{{ $e->nome }}</option>
    @endforeach
    </select>
    </div>

    <div class="form-floating mb-3">
    <input type="number" class="form-control" step="0.01" id="valor_consulta" 
    placeholder="Valor consulta" name="valor_consulta">
    <label for="valor_consulta">Valor da consulta</label>
    </div>
    
   
    <input type="submit" value="Salvar" 
        class="btn btn-success" />
</form>
@endsection
