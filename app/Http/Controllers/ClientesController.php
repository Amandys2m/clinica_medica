<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClientesController extends Controller
{
    function listar(){
        $clientes = Cliente::all();

        return view('clientes_listar', compact('clientes'));
    }

    function novo(){
        $clientes = Cliente::all();
        return view('cliente_novo');
    }
    function salvar(Request $req, $id=null){
        if ($id) {
            $c = Cliente::findOrFail($id);
            $operacao = "alterado";
        } else {
            $c = new Cliente();
            $operacao = "inserido";
        }
        $c->nome = $req->nome;
        $c->cpf = $req->cpf;
        $c->rg = $req->rg;
        $c->data_nasc = $req->data_nasc;
        $c->telefone = $req->telefone;
        $c->email = $req->email;
        $c->senha = $req->senha;
        $c->save();

        session()->flash("mensagem", "O cliente {$c->nome} foi {$operacao} com sucesso.");

        return redirect('/clientes');
    }

    function edit($id){
        $c = Cliente::findOrFail($id);
        $clientes = Cliente::all();

        return view('clientes_editar', ['c' => $c]);
    }

    function delete($id){
        $c = Cliente::findOrFail($id);
        $c->delete();
        session()->flash("mensagem", "O cliente {$c->nome} foi excluido com sucesso.");

        return redirect('/clientes');
    }
}
