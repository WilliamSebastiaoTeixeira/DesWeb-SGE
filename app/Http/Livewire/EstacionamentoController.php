<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use App\Models\Estacionamento;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isEmpty;

class EstacionamentoController extends Component
{
    public $fantasia = ''; 
    public $latitude = ''; 
    public $longitude = ''; 

    protected $rules = [
        'fantasia' => 'required|min:1|max:255|', 
        'latitude' => 'required|min:1|max:255|', 
        'longitude' => 'required|min:1|max:255|',
    ];

    public function render()
    {
        abort_if(Gate::denies('empresa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $estacionamento = []; 

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
                ]); 
    
                $this->fantasia  = ''; 
                $this->latitude  = ''; 
                $this->longitude = '';

                session()->flash('success','Estacionamento criado com sucesso!!');
            }
        }catch(\Exception $e){
            session()->flash('error','Ops, ocorreu algum erro!');
        }
    }

    public function destroy($id){
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
