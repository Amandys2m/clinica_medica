<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Agendamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'profissional_id',
        'data',
        'horario'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function profissional()
    {
        return $this->belongsTo(Profissional::class);
    }
}

