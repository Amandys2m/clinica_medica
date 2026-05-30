<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agendamento;
use App\Models\Cliente;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); 
        $cliente = Cliente::where('email', $user->email)->first();
        $agendamentos =Agendamento::with('profissional')
            ->where("cliente_id", $cliente->id)
            ->orderBy("data", 'desc')
            ->orderBy("horario", 'desc')
            ->get();
        return view('dashboard', compact('user','agendamentos'));
    }
}
