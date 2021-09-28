<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Estacionamento; 
use Illuminate\Http\Request;
use Mapper; 

class MapaController extends Controller
{
    private function mapaContent($id,$fantasia, $action, $button)
    {
        return ['content' => '
            <div class="p-2 d-flex flex-column">
                <div class="">
                    '.$fantasia.'
                </div>
                <div class="align-self-center">
                    <form method="GET" action="'.$action.'"><br>
                        <input type="hidden" id="id" name="id" value="'.$id.'">
                        <button "type="submit" class="btn btn-outline-success">'.$button.'</button>
                    </form>
                </div>
            </div>
        '];
    }

    public function index()
    {
        Mapper::map(-28.936090514091237, -49.47023485593878, ['zoom' => 18]);

        try{
            $user = User::find(auth()->user()->id);
            if($user->roles[0]->title === 'Empresa'){
                foreach(Estacionamento::where('empresa_id','=', $user->userType->id)->get() as $estacionamento){
                    Mapper::marker($estacionamento->latitude,$estacionamento->longitude, $this->mapaContent($estacionamento->id, $estacionamento->fantasia, "../gerenciar", "Informações")); 
                }
            }else if($user->roles[0]->title === 'Pessoa'){
                foreach(Estacionamento::get() as $estacionamento){
                    Mapper::marker($estacionamento->latitude,$estacionamento->longitude, $this->mapaContent($estacionamento->id, $estacionamento->fantasia, "../solicitar", "Solicitar Vaga")); 
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
