<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $fillable = ['pessoa_id', 'placa', 'modelo', 'ano']; 

    public function pessoa(){
        return $this->belongsTo(Pessoa::class); 
    }
}
