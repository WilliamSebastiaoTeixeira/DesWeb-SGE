<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use App\Models\Estacionamento;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Mapper; 


use function PHPUnit\Framework\isEmpty;

class EstacionamentoController extends Component
{
    public $fantasia = ''; 
    public $latitude = ''; 
    public $longitude = ''; 
    public $qtd_vagas = ''; 

    protected $rules = [
        'fantasia' => 'required|min:1|max:255|', 
        'latitude' => 'required|min:1|max:255|', 
        'longitude' => 'required|min:1|max:255|',
        'qtd_vagas' => 'required|min:1|max:4|', 
    ];

    public function render()
    {
        abort_if(Gate::denies('empresa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estacionamento = [];

        Mapper::map(-28.936091051367864, -49.48315979766263, ['zoom' => 15 , 'eventAfterLoad' => '']);

        try{ 
            $empresa = Empresa::where('user_id','=' ,auth()->user()->id)->get();
            $estacionamento = Estacionamento::where('empresa_id', '=', $empresa[0]->id)->latest()->get();    
        }
        catch(\Exception $e){
            if($e->getMessage() === "Undefined offset: 0"){
                session()->flash('error','Cadastre um CNPJ no perfil!!');
            }else{
                session()->flash('error','Ops, ocorreu algum erro!!');
            } 
        } 

        return view('livewire.estacionamento-controller', ['estacionamentos' => $estacionamento]);
    }


    public function criar(){
        abort_if(Gate::denies('empresa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $this->validate();

        try{
            $empresa = Empresa::where('user_id','=' ,auth()->user()->id)->get();
            if(empty($empresa[0])){
                session()->flash('error','Cadastre um CNPJ no perfil!!');
            }else{
                $empresa[0]->estacionamento()->create([
                    'fantasia' => $this->fantasia, 
                    'latitude' => $this->latitude, 
                    'longitude' => $this->longitude, 
                    'qtd_vagas' => $this->qtd_vagas, 
                ]); 
    
                $this->fantasia  = ''; 
                $this->latitude  = ''; 
                $this->longitude = '';
                $this->qtd_vagas = '';

                session()->flash('success','Estacionamento criado com sucesso!!');
            }
        }catch(\Exception $e){
            session()->flash('error','Ops, ocorreu algum erro!');
        }
    }

    public function destroy($id){
        abort_if(Gate::denies('empresa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try{
            $estacionamento = Estacionamento::find($id);
            
            if((Empresa::where('user_id','=' ,auth()->user()->id)->get())[0]->id === $estacionamento->empresa_id){
                $estacionamento->delete(); 
                session()->flash('success',"Estacionamento deletado com sucesso!!");
            }else{
                session()->flash('error',"Algo deu errado ao tentar deletar!!");
            }
        }catch(\Exception $e){
            session()->flash('error',"Algo deu errado ao tentar deletar!!");
        }
    }
}
