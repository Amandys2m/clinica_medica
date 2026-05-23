@extends('main')

@section('titulo', "Convênio #{$cv->id}")

@section('conteudo')
<h1>Convênio #{{ $cv->id }}</h1>
<form method="POST" action="{{ route('convenio.salvar', ['id' => $cv->id]) }}">
    @csrf
    <div class="form-floating mb-3">
    <input type="text" class="form-control" 
    id="nome" placeholder="Nome" name="nome" value="{{ $cv->nome }}">
    <label for="nome">Nome</label>
    </div>
    <div class="form-floating mb-3">
    <input type="number" class="form-control" 
    id="telefone" placeholder="Telefone" name="telefone" value="{{ $cv->telefone }}">
    <label for="telefone">Telefone</label>
    </div>
    
    <input type="submit" value="Salvar" 
        class="btn btn-success" />
</form>
@endsection
