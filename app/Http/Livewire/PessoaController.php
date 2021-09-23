<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pessoa; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PessoaController extends Component
{
    public $cpf = ''; 
    
    protected $rules = [
        'cpf' => 'required|min:14|max:14|', 
    ]; 

    public function render()
    {
        abort_if(Gate::denies('pessoa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
 
        $user = ''; 
        try{
            if(Pessoa::where('user_id','=' ,auth()->user()->id)->exists()){
                $user = Pessoa::where('user_id','=' ,auth()->user()->id)->get();
                $this->cpf = $user[0]->cpf; 
            }
        }catch(\Exception $e){
            session()->flash('error','Ops, ocorreu algum erro!');
        }
        return view('livewire.pessoa-controller', ['user' => $user]);
    }

    public function update()
    {
        abort_if(Gate::denies('pessoa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $this->validate();

        try{
            if(Pessoa::where('user_id','=' ,auth()->user()->id)->exists()){
                auth()->user()->userType()->update([
                    'cpf' => $this->cpf, 
                ]);
            }else{
                auth()->user()->userType()->create([
                    'cpf' => $this->cpf, 
                ]); 
            }
            Session::flash('success','Salvo!!'); 
        }catch(\Exception $e){
            session()->flash('error','Ops, ocorreu algum erro!');
        }
    }
}
