<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Estacionamento; 
use Illuminate\Http\Request;
use Mapper; 

class MapaController extends Controller
{
    public function index()
    {
        Mapper::map(0,0, ['zoom' => 18]);

        try{
            $user = User::find(auth()->user()->id);
            if($user->roles[0]->title === 'Empresa'){
                //Retorna só os próprios estacionamentos para usuarios do tipo Empresa
                foreach(Estacionamento::where('empresa_id','=', $user->userType->id)->get() as $estacionamento){
                    Mapper::informationWindow($estacionamento->latitude,$estacionamento->longitude, $estacionamento->fantasia);

                }
            }else if($user->roles[0]->title === 'Pessoa'){
                foreach(Estacionamento::get() as $estacionamento){
                    Mapper::informationWindow($estacionamento->latitude,$estacionamento->longitude, $estacionamento->fantasia);
                }
            }
        }catch(\Exception $e){
            if($e->getMessage() === "Trying to get property 'id' of non-object"){
                session()->flash('error','Ops, parace que voce não tem nenhum estacionamento cadastrado para exibir!!');
            }else{
                session()->flash('error','Ops, ocorreu algum erro!!');
            }
        }

        return view('mapa.index'); 
    }
}
