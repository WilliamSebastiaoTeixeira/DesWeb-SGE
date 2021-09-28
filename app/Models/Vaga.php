<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = ['estacionamento_id', 'carro_id']; 

    public function estacionamento(){
        return $this->belongsTo(Estacionamento::class); 
    }

    public function carro(){
        return $this->hasOne(Carro::class); 
    }
}
