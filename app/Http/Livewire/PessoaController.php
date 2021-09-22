<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pessoa; 
use Illuminate\Support\Facades\Session;

class PessoaController extends Component
{
    public $cpf = ''; 
    
    protected $rules = [
        'cpf' => 'required|min:14|max:14|', 
    ]; 

    public function render()
    { 
        $user = ''; 
        if(Pessoa::where('user_id','=' ,auth()->user()->id)->exists()){
            $user = Pessoa::where('user_id','=' ,auth()->user()->id)->get();
            $this->cpf = $user[0]->cpf; 
        }
        return view('livewire.pessoa-controller', ['user' => $user]);
    }

    public function update()
    {
        $this->validate();

        Session::flash('message','Salvo!!'); 

        if(Pessoa::where('user_id','=' ,auth()->user()->id)->exists()){
            auth()->user()->userType()->update([
                'cpf' => $this->cpf, 
            ]);
        }else{
            auth()->user()->userType()->create([
                'cpf' => $this->cpf, 
            ]); 
        }
    }
}
