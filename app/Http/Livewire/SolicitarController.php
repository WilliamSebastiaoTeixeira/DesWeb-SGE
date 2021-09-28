<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Estacionamento;
use App\Models\Vaga;
use App\Models\Pessoa;
use App\Models\Carro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SolicitarController extends Component
{
    public $carro = ''; 
    public $estacionamento = ''; 

    public function render(Request $request)
    {
        $carro_db = []; 
        abort_if(Gate::denies('pessoa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            $estacionamento = Estacionamento::get(); 
            return view('livewire.solicitar-controller',['estacionamentos' => $estacionamento, 'carros' => $carro_db,'id' => $request->id]);
        }catch(\Exception $e){
            session()->flash('error','Ops, ocorreu algum erro!!');
        }
    }

    public function solicitar(){
        abort_if(Gate::denies('pessoa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            if($this->carro == ''){
                session()->flash('error','Selecione um carro!!');
            }else if($this->estacionamento == ''){
                session()->flash('error','Selecione um estacionamento!!');
            }else{
                $pessoa = Pessoa::where('user_id','=' ,auth()->user()->id)->get();
                $carro_db = Carro::where('pessoa_id', '=', $pessoa[0]->id)->latest()->get(); 
                foreach($carro_db as $carro){
                    if($carro->id !== $this->carro){
                        throw new \Exception("");
                    }
                }
                $estacionamento = Estacionamento::where('id','=',$this->estacionamento)->get();
                $vagas = Vaga::where('estacionamento_id','=',$this->estacionamento)->get(); 
                if(empty($vagas[0])){
                    Vaga::create([
                        'estacionamento_id' => $this->estacionamento, 
                        'carro_id' => $this->carro, 
                    ]); 
                    session()->flash('success','Vaga solicitada com sucesso!!');
                }else{
                    foreach($vagas as $vaga){
                        if($vaga->carro_id == $this->carro){
                            throw new \Exception("Carro já está cadastrado em uma vaga");
                        }
                    }
                    if(count($vagas) <= (int)$estacionamento[0]->qtd_vagas){
                        Vaga::create([
                            'estacionamento_id' => $this->estacionamento, 
                            'carro_id' => $this->carro, 
                        ]);
                        session()->flash('success','Vaga solicitada com sucesso!!');
                    }else{
                        session()->flash('error','Estacionamento cheio!!!');
                    }
                }
            }
        }catch(\Exception $e){
            if($e->getMessage() === "Carro já está cadastrado em uma vaga"){
                session()->flash('error',$e->getMessage());
            }else{
                session()->flash('error','Ops, ocorreu algum erro!!');
            }
        }
    }
}
