<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Convenio;

class ConveniosController extends Controller
{
    function listar(){
        $convenios = Convenio::paginate(10);

        return view('convenios_listar', compact('convenios'));
    }

    function novo(){
        $convenios = Convenio::all();
        return view('convenio_novo');
    }
    function salvar(Request $req, $id=null){
        if ($id) {
            $cv = Convenio::findOrFail($id);
            $operacao = "alterado";
        } else {
            $cv = new Convenio();
            $operacao = "inserido";
        }
        $cv->nome = $req->nome;
        $cv->telefone = $req->telefone;
        $cv->save();

        session()->flash("mensagem", "O convênio {$cv->nome} foi {$operacao} com sucesso.");

        return redirect('/convenios');
    }

    function editar($id){
        $cv = Convenio::findOrFail($id);
        $convenios = Convenio::all();

        return view('convenios_editar', ['cv' => $cv]);
    }

    function delete($id){
        $cv = Convenio::findOrFail($id);
        $cv->delete();
        session()->flash("mensagem", "O convênio {$cv->nome} foi excluido com sucesso.");

        return redirect('/convenios');
    }
}



