@extends('main')

@section('titulo', 'Novo convênio')

@section('conteudo')
<h1>Novo Convênio</h1>
<form method="POST" action="{{ route('convenio.salvar') }}">
    @csrf
    <div class="form-floating mb-3">
    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" value="{{ old ('nome') }}">
    <label for="nome">Nome</label>
    </div>
     <div class="form-floating mb-3">
    <input type="number" class="form-control" id="telefone" placeholder="Telefone" name="telefone" value="{{ old ('telefone') }}">
    <label for="telefone">Telefone</label>
    </div>

    <input type="submit" value="Salvar" 
        class="btn btn-success" />
</form>
@endsection
