<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Agendamento;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); 
        
        if ($user->is_admin) {
            $agendamentos = collect();

            $agendamentosPorEspecialidade = DB::table('agendamentos')
                ->join('profissionais', 'agendamentos.profissional_id', '=', 'profissionais.id')
                ->join('especialidades_profissionais', 'profissionais.id', '=', 'especialidades_profissionais.profissional_id')
                ->join('especialidades', 'especialidades_profissionais.especialidade_id', '=', 'especialidades.id')
                ->select('especialidades.nome', DB::raw('count(agendamentos.id) as total'))
                ->groupBy('especialidades.nome')
                ->get();

            $labelsEspecialidades = $agendamentosPorEspecialidade->pluck('nome');
            $dadosEspecialidades = $agendamentosPorEspecialidade->pluck('total');

            $agendamentosPorProfissional = DB::table('agendamentos')
                ->join('profissionais', 'agendamentos.profissional_id', '=', 'profissionais.id')
                ->select('profissionais.nome', DB::raw('count(agendamentos.id) as total'))
                ->groupBy('profissionais.nome')
                ->get();

            $labelsProfissionais = $agendamentosPorProfissional->pluck('nome');
            $dadosProfissionais = $agendamentosPorProfissional->pluck('total');

            $agendamentosPorConvenio = DB::table('agendamentos')
                ->leftJoin('convenios', 'agendamentos.convenio_id', '=', 'convenios.id')
                ->select(DB::raw('COALESCE(convenios.nome, "Particular") as convenio_nome'), DB::raw('count(agendamentos.id) as total'))
                ->groupBy('convenio_nome')
                ->get();

            $labelsConvenios = $agendamentosPorConvenio->pluck('convenio_nome');
            $dadosConvenios = $agendamentosPorConvenio->pluck('total');

            return view('dashboard', compact(
                'user', 'agendamentos', 
                'labelsEspecialidades', 'dadosEspecialidades',
                'labelsProfissionais', 'dadosProfissionais',
                'labelsConvenios', 'dadosConvenios'
            ));
        }
        
        $cliente = Cliente::where('email', $user->email)->first();
        $agendamentos = Agendamento::with('profissional')
            ->where("cliente_id", $cliente->id)
            ->orderBy("data", 'desc')
            ->orderBy("horario", 'desc')
            ->paginate(5);
            
        return view('dashboard', compact('user','agendamentos'));
    }
}