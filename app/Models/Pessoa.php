<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = ['cpf']; 

    public function user(){
        $this->belongsTo(User::class);
    }

    public function carro(){
        return $this->hasMany(Carro::class); 
    }
}
