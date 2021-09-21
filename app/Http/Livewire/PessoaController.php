<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pessoa; 

class PessoaController extends Component
{
    protected $cpf = ''; 
    
    protected $rules = [
        'cpf' => 'required|min:6|max:7|', 
    ]; 

    public function render()
    {
        $user = Pessoa::where('user_id','=' ,auth()->user()->id)->get(); 
        return view('livewire.pessoa-controller', ['user' => $user[0]]);
    }
}
