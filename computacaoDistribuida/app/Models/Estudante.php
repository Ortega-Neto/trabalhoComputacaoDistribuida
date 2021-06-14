<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudante extends Model
{
    protected $fillable = [
        'id',
        'rga',
        'nome',
        'cpf',
        'data_nascimento',
        'curso',
    ];
    
    public static function buscarEstudantePeloNome($nome) {
        $alunos = Estudante::query()
                ->where('nome', 'LIKE', "%{$nome}%") 
                ->orderBy('created_at')
                ->get(); 
        
        $arrayDeAlunos = json_decode($alunos, true);
        
        return json_encode($arrayDeAlunos);
    }
}
