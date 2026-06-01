<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    protected $table = 'especialidades';

    protected $fillable = [
        'nome',
        'desc_esp'
    ];
    
     public function profissionais()
    {
        return $this->belongsToMany(
            Profissional::class,
            'especialidades_profissionais',
            'especialidade_id',
            'profissional_id'
        )->withPivot('valor_consulta');
    }
}
