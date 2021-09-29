<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Component;
use App\Models\Estacionamento;
use App\Models\Vaga;
use App\Models\Pessoa;
use App\Models\Empresa;
use App\Models\Carro;
use Illuminate\Http\Request;

class GerenciaController extends Component
{
    public function render(Request $request)
    {
        abort_if(Gate::denies('empresa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $estacionamento = []; 
        
        try{
            foreach((Estacionamento::where('Empresa_id', '=', (empresa::where('user_id','=' ,auth()->user()->id)->get())[0]->id)->get()) as $estacionamento_db){
                $temp = [];
                foreach((Vaga::where('estacionamento_id', '=', $estacionamento_db->id)->get()) as $vaga_db){
                    array_push($temp, [
                        'id' => $vaga_db->id,
                        'carro' => ['id' => $vaga_db->carro_id, 'modelo' => (Carro::where('id','=',$vaga_db->carro_id)->get())[0]->modelo,], 
                    ]); 
                }
                array_push($estacionamento,[
                    'id' => $estacionamento_db->id, 
                    'fantasia' => $estacionamento_db->fantasia, 
                    'vagas' => $temp
                ]); 
            }
            if(empty($estacionamento)){
                throw new \Exception("Cadastre um estacionamento!!");
            }
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
        }
        return view('livewire.gerencia-controller', ['estacionamentos' => $estacionamento, 'id' => $request->id]);
    }

    public function retirada($id){
        abort_if(Gate::denies('empresa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try{
            $vaga = Vaga::where('id','=',(int)$id)->get();
            if((Estacionamento::where('id', '=', (int)$vaga[0]->estacionamento_id)->get())[0]->empresa->id != ((empresa::where('user_id','=' ,auth()->user()->id)->get())[0]->id)){
                throw new \Exception("Erro não foi possível encontrar o usuário!!");
            }
            $vaga[0]->delete(); 
            session()->flash('success',"Carro retirado com sucesso!!");
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
        }
    }
}
