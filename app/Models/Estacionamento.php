<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estacionamento extends Model
{
    use HasFactory;
    protected $fillable = ['empresa_id', 'fantasia', 'latitude', 'longitude']; 

    public function empresa(){
        return $this->belongsTo(Empresa::class); 
    }
}
