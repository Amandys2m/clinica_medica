<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Configuracao;

class ConfiguracaoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if (!$user->is_admin) {
            return redirect('/dashboard')->with('erro', 'Acesso negado.');
        }

        $cacapay_url = Configuracao::where('chave', 'cacapay_url')->value('valor');
        $cacapay_token = Configuracao::where('chave', 'cacapay_token')->value('valor');

        return view('configuracoes', compact('user', 'cacapay_url', 'cacapay_token'));
    }

    public function salvar(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->is_admin) {
            return redirect('/dashboard')->with('erro', 'Acesso negado.');
        }

        $request->validate([
            'cacapay_url' => 'nullable|url',
            'cacapay_token' => 'nullable|string',
        ]);

        Configuracao::updateOrCreate(
            ['chave' => 'cacapay_url'],
            ['valor' => $request->cacapay_url]
        );

        Configuracao::updateOrCreate(
            ['chave' => 'cacapay_token'],
            ['valor' => $request->cacapay_token]
        );

        return redirect()->back()->with('sucesso', 'Configurações do sistema atualizadas.');
    }
}