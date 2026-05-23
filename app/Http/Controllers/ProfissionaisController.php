<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profissional;
use App\Models\Especialidade;

class ProfissionaisController extends Controller
{
   function listar(){
        $profissionais = Profissional::with('especialidades')->get();

        return view('profissionais_listar', compact('profissionais'));
    }

    function novo(){
        $especialidades = Especialidade::all();
        return view('profissional_novo', compact('especialidades'));
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

        $valor = str_replace(',', '.', $req->valor_consulta);
        $p->especialidades()->sync([$req->especialidade => ['valor_consulta' => $valor]]);
        
        session()->flash("mensagem", "O profissional {$p->nome} foi {$operacao} com sucesso.");

        return redirect('/profissionais');
    }

    function editar($id){
        $p = Profissional::with('especialidades')->findOrFail($id);
        $especialidades = Especialidade::all();

        return view('profissionais_editar', ['p' => $p,
                'especialidades' => $especialidades]);
    }

    function delete($id){
        $p = Profissional::findOrFail($id);
        $p->especialidades()->detach();
        $p->delete();
        session()->flash("mensagem", "O profissional {$p->nome} foi excluido com sucesso.");

        return redirect('/profissionais');
    }
}
