<?php

namespace App\Http\Livewire;

use App\Models\Pessoa; 
use App\Models\Carro; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Component;

class CarroController extends Component
{
    public $placa = ''; 
    public $modelo = ''; 
    public $ano = ''; 

    protected $rules = [
        'placa' => 'required|min:6|max:7|', 
        'modelo' => 'required|min:1|max:255', 
        'ano' => 'required|min:1|max:255',
    ];

    public function render()
    { 
        abort_if(Gate::denies('pessoa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $carro = []; 

        try{
            $pessoa = Pessoa::where('user_id','=' ,auth()->user()->id)->get();
            $carro = Carro::where('pessoa_id', '=', $pessoa[0]->id)->latest()->get();
        }
        catch(\Exception $e){
            if($e->getMessage() === "Undefined offset: 0"){
                session()->flash('error','Cadastre um CPF no perfil!!');
            }else{
                session()->flash('error','Ops, ocorreu algum erro!!');
            } 
        } 
        return view('livewire.carro-controller', ['carros' => $carro]);
    }

    public function criar(){
        abort_if(Gate::denies('pessoa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->validate();

        try{
            $pessoa = Pessoa::where('user_id','=' ,auth()->user()->id)->get();
            if(empty($pessoa[0])){
                session()->flash('error','Cadastre um CPF no perfil!!');
            }else{
                $pessoa[0]->carro()->create([
                    'placa' => $this->placa,
                    'modelo' => $this->modelo, 
                    'ano' => $this->ano,
                ]); 
    
                $this->placa = ''; 
                $this->modelo = ''; 
                $this->ano = ''; 

                session()->flash('success','Carro criado com sucesso!!');

            }
        }catch(\Exception $e){
            session()->flash('error','Ops, ocorreu algum erro!!');
        }
    }

    public function destroy($id){
        try{
            Carro::find($id)->delete();
            session()->flash('success',"Carro deletado com sucesso!!");
        }catch(\Exception $e){
            session()->flash('error',"Algo deu errado ao tentar deletar!!");
        }
    }
}
