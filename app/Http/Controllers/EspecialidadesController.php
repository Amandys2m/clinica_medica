<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidade;

class EspecialidadesController extends Controller
{
    function listar(){
        $especialidades = Especialidade::paginate(10);

        return view('especialidades_listar', compact('especialidades'));
    }

    function nova(){
        $especialidades = Especialidade::all();
        return view('especialidade_nova');
    }
    function salvar(Request $req, $id=null){
        if ($id) {
            $e = Especialidade::findOrFail($id);
            $operacao = "alterado";
        } else {
            $e = new Especialidade();
            $operacao = "inserido";
        }
        $e->nome = $req->nome;
        $e->desc_esp = $req->desc_esp;
        $e->save();

        session()->flash("mensagem", "A especialidade {$e->nome} foi {$operacao} com sucesso.");

        return redirect('/especialidades');
    }

    function editar($id){
        $e = Especialidade::findOrFail($id);
        $especialidades = Especialidade::all();

        return view('especialidades_editar', ['e' => $e]);
    }

    function delete($id){
        $e = Especialidade::findOrFail($id);
        $e->delete();
        session()->flash("mensagem", "A especialidade {$e->nome} foi excluido com sucesso.");

        return redirect('/especialidades');
    }
}


