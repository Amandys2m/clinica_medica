<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    protected $table = 'profissionais';

    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'data_nasc'
    ];

     public function especialidades()
    {
        return $this->belongsToMany(
            Especialidade::class,
            'especialidades_profissionais',
            'profissional_id',
            'especialidade_id'
        )->withPivot('valor_consulta');
    }
}
