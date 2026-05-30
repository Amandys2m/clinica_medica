<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use App\Models\Profissional;
use App\Models\Cliente;
use App\Models\Especialidade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
       public function listar()
    {
        $agendamentos = Agendamento::with(['cliente', 'profissional'])->get();
        
        return view('agendamentos_listar', compact('agendamentos'));
    }
    public function novo(Request $request)
    {
        $especialidades = Especialidade::all();
        $profissionais = collect();

        $especialidadeSelecionada = $request->especialidade_id;
        if ($especialidadeSelecionada) {
            $profissionais = DB::table('profissionais')
                ->join('especialidades_profissionais', 'profissionais.id', '=', 'especialidades_profissionais.profissional_id')
                ->where('especialidades_profissionais.especialidade_id', $especialidadeSelecionada)
                ->select('profissionais.id', 'profissionais.nome')
                ->get();
        }
        return view('agendamento_novo', compact('especialidades', 'profissionais', 'especialidadeSelecionada'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function salvar(Request $request)
    {
        $request->validate([
            'profissional_id' => 'required|exists:profissionais,id',
            'data' => 'required|date|after_or_equal:today',
            'horario' => 'required|date_format:H:i',
        ]);
        $conflito = Agendamento::where('profissional_id', $request->profissional_id)
                               ->where('data', $request->data)
                               ->where('horario', $request->horario)
                               ->first();
        if ($conflito){
            return back()
                   ->withErrors(['horario' => 'Este horário já está reservado para o profissional selecionado. Por favor, escolha outro.'])
                   ->withInput();
        }
        $cliente = Cliente::where('email', Auth::user()->email)->first();

        $agendamento = new Agendamento();
        $agendamento->cliente_id = $cliente->id;
        $agendamento->profissional_id = $request->profissional_id;
        $agendamento->data = $request->data;
        $agendamento->horario = $request->horario;
        $agendamento->save();

        return redirect('/dashboard')->with('sucesso', 'Consulta agendada com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function editar($id)
        {
            $agendamento = Agendamento::findOrFail($id);
            $especialidades = Especialidade::all();
            $profissionais = Profissional::all();
            
            return view('agendamento_editar', compact('agendamento', 'especialidades', 'profissionais'));
        }
    /**
     * Display the specified resource.
     */
    public function delete($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->delete();

        return back()->with('mensagem', 'Agendamento excluído com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agendamento $agendamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agendamento $agendamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agendamento $agendamento)
    {
        //
    }
}
