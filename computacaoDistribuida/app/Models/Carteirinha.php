<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carteirinha extends Model
{
    protected $fillable = [
        'id',
        'rga_carteirinha',
        'data_emissao',
    ];
    
    public static function buscarRGA($rga) {
        $estudante = Estudante::query()
                ->where('rga', $rga) 
                ->orderBy('created_at')
                ->get(); 
        
        return $estudante;
    }
}
