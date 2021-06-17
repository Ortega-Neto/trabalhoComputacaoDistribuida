<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'data',
        'lote',
        'valor_lote',
        'id_responsavel',
    ];
    
    public static function buscarIdResponsavel($id) {
        $user = Responsavel::query()
                ->where('id', $id)
                ->get();
        
        return $user;
    }
}
