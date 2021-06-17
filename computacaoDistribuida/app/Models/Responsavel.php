<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{    
    protected $fillable = [
        'id',
        'id_responsavel',
        'id_evento'       
    ];
    
    public static function buscarIdUser($id) {
        $user = User::query()
                ->where('id', $id)
                ->get();
        
        return $user;
    }
}
