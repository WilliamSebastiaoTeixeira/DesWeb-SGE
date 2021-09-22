<?php

namespace App\Http\Livewire;
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
        $carros = Carro::where('user_id','=' ,auth()->user()->id)->latest()->get(); 
        return view('livewire.carro-controller', [
            'carros' => $carros,
        ]);
    
    }

    public function criar(){
        Session::flash('message','Criado!!'); 

        try{
            auth()->user()->carro()->create([
                'placa' => $this->placa,
                'modelo' => $this->modelo, 
                'ano' => $this->ano,
            ]); 
            session()->flash('success',"Carro Criado!!");

            $this->placa = ''; 
            $this->modelo = ''; 
            $this->ano = ''; 
        }catch(\Exception $e){
            session()->flash('error',"Não foi possível criar!!");
        }

    }
    public function destroy($id){
        try{
            Carro::find($id)->delete();
            session()->flash('success',"Car Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong while deleting car!!");
        }
    }
}
