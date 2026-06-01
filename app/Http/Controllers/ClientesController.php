<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClientesController extends Controller
{
    function listar(){
        $clientes = Cliente::paginate(10);

        return view('clientes_listar', compact('clientes'));
    }

    function novo(){
        $clientes = Cliente::all();
        return view('cliente_novo');
    }
    function salvar(Request $req, $id=null){
        $req->validate([
            'nome'=>'required|string|max:255',
            'cpf'=>'required|string|max:11',
            'rg'=>'required|string|max:11',
            'data_nasc'=>'required|date',
            'telefone'=>'required|string|max:15',
            'email'=>'required|email',
            'senha'=> $id ? 'nullable|string|min:6' : 'required|string|min:6'
        ]);
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
        if($req->senha){
        $c->senha = Hash::make($req->senha); }
        $c->save();

        if($operacao=="inserido"){
            $user = new User();
            $user->name = $req->nome;
            $user->email = $req->email;
            $user->password = Hash::make($req->senha);
            $user->is_admin = false;
            $user->save();

            session()->flash("mensagem", "Cadastro realizado com sucesso. Faça login.");
            return redirect ('/login');
        }

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
