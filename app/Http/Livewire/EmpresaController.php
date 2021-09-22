<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Empresa; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class EmpresaController extends Component
{
    public $cnpj = ''; 

    protected $rules = [
        'cnpj' => 'required|min:18|max:18|', 
    ]; 

    public function render()
    {
        abort_if(Gate::denies('empresa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = ''; 

        if(Empresa::where('user_id','=' ,auth()->user()->id)->exists()){
            $user = Empresa::where('user_id','=' ,auth()->user()->id)->get();
            $this->cnpj = $user[0]->cnpj; 
        }
        return view('livewire.empresa-controller', ['user' => $user]);
    }

    public function update()
    {
        abort_if(Gate::denies('empresa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $this->validate();

        Session::flash('message','Salvo!!'); 

        if(Empresa::where('user_id','=' ,auth()->user()->id)->exists()){
            auth()->user()->userType()->update([
                'cnpj' => $this->cnpj, 
            ]);
        }else{
            auth()->user()->userType()->create([
                'cnpj' => $this->cnpj, 
            ]); 
        }
    }
}
