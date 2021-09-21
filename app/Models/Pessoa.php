<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = ['cpf']; 

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function user(){
        $this->belongsTo(User::class);
    }
}
