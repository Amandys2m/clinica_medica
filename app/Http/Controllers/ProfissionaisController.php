<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profissional;

class ProfissionaisController extends Controller
{
   function listar(){
        $profissionais = Profissional::all();

        return view('profissionais_listar', compact('profissionais'));
    }

    function novo(){
        $profissionais = Profissional::all();
        return view('profissional_novo');
    }
    function salvar(Request $req, $id=null){
        if ($id) {
            $p = Profissional::findOrFail($id);
            $operacao = "alterado";
        } else {
            $p = new Profissional();
            $operacao = "inserido";
        }
        $p->nome = $req->nome;
        $p->cpf = $req->cpf;
        $p->rg = $req->rg;
        $p->data_nasc = $req->data_nasc;
        $p->save();

        session()->flash("mensagem", "O profissional {$p->nome} foi {$operacao} com sucesso.");

        return redirect('/profissionais');
    }

    function editar($id){
        $p = Profissional::findOrFail($id);
        $profissionais = Profissional::all();

        return view('profissionais_editar', ['p' => $p]);
    }

    function delete($id){
        $p = Profissional::findOrFail($id);
        $p->delete();
        session()->flash("mensagem", "O profissional {$p->nome} foi excluido com sucesso.");

        return redirect('/profissionais');
    }
}
