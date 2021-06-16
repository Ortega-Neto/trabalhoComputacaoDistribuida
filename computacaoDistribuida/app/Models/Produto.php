<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'tamanho',
        'quantidade',
        'preco',
        'id_administrador'        
    ];
    
    public static function buscarIdUser($id) {
        $user= User::query()
                ->where('id', $id)
                ->get();
        
        return $user;
    }
}
