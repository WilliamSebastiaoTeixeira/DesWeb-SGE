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
        $vagas = [];

        abort_if(Gate::denies('pessoa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            $carro_db = Carro::where('pessoa_id', '=', (Pessoa::where('user_id','=' ,auth()->user()->id)->get())[0]->id)->latest()->get(); 
            $estacionamento = Estacionamento::get();
            
            foreach($carro_db as $carro){
                $vaga_db = Vaga::where('carro_id', '=', $carro->id)->get();
                if(empty($vaga_db[0]) == false){
                    array_push($vagas, [
                        'id' =>  $vaga_db[0]->id,
                        'estacionamento' => (Estacionamento::where('id','=',$vaga_db[0]->estacionamento_id)->get())[0]->fantasia,
                        'carro' => ['modelo' => (Carro::where('id','=',$vaga_db[0]->carro_id)->get())[0]->modelo, 'id' => (Carro::where('id','=',$vaga_db[0]->carro_id)->get())[0]->id],
                    ]);
                }
            } 
            return view('livewire.solicitar-controller',['estacionamentos' => $estacionamento, 'carros' => $carro_db, 'id' => $request->id, 'vagas' => $vagas]);
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
        }
    }

    public function retirada($id,$carro){
        try{
            $vaga = Vaga::find($id);
            $carro = Carro::where('id', '=', (int)$carro)->get();
            
            if($carro[0]->pessoa_id != (Pessoa::where('user_id','=' ,auth()->user()->id)->get())[0]->id ){
                throw new \Exception("Erro não foi possível encontrar o usuário!!");
            }
            $vaga->delete(); 
            session()->flash('success',"Carro retirado com sucesso!!");
        }catch(\Exception $e){

            dd($e); 
            session()->flash('error',$e->getMessage());
        }
    }

    public function solicitar(){
        abort_if(Gate::denies('pessoa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            if($this->carro == ''){
                throw new \Exception("Selecione um carro!!");
            }

            if($this->estacionamento == ''){
                throw new \Exception("Selecione uma vaga!!");
            }

            if((Carro::where([
                ['pessoa_id', '=', (Pessoa::where('user_id','=' ,auth()->user()->id)->get())[0]->id],
                ['id', '=', (int)$this->carro], 
            ])->latest()->get())->isEmpty() == true){
                throw new \Exception("Ops, ocorreu algum erro!!");
            } 

            $estacionamento = Estacionamento::where('id', '=', (int)$this->estacionamento)->latest()->get(); 
            if($estacionamento->isEmpty() == true){
                throw new \Exception("Ops, ocorreu algum erro!!");
            } 

            foreach(Vaga::get() as $vaga){
                if($vaga->carro_id == $this->carro){
                    throw new \Exception("Carro já está cadastrado em uma vaga");
                }
            }
            
            $vagas = Vaga::where('estacionamento_id','=',$this->estacionamento)->get(); 
            if(count($vagas) < (int)$estacionamento[0]->qtd_vagas){
                Vaga::create([
                    'estacionamento_id' => $this->estacionamento, 
                    'carro_id' => $this->carro, 
                ]);
                session()->flash('success','Vaga solicitada com sucesso!!');
            }else{
                session()->flash('error','Estacionamento cheio!!!');
            }
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
        }
    }
}
