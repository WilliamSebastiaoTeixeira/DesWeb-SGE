<div>
   <div class="container-fluid">
      <div class="row">
         <div class="col pt-2">
            <div class="card">
               <div class="card-header">
                  Estacionamentos e Vagas
               </div>
               <div class="card-body">
                  @foreach ($estacionamentos as $estacionamento)
                     <div class="card mb-3">
                        <div class="card-header">
                           <button id="{{'Abrir_'.$estacionamento['id']}}" class="pr-3"><i class="bi bi-arrow-down"></i></button>
                           {{$estacionamento['fantasia']}}
                        </div>
                        <script>
                           document.getElementById("{{'Abrir_'.$estacionamento['id']}}").addEventListener("click",()=>{
                              if(document.getElementById("{{'Abrir_'.$estacionamento['id']}}").childNodes[0].classList[1] === "bi-arrow-down"){
                                 document.getElementById("{{'Abrir_'.$estacionamento['id']}}").childNodes[0].classList.toggle("bi-arrow-down");
                                 document.getElementById("{{'Abrir_'.$estacionamento['id']}}").childNodes[0].classList.toggle("bi-arrow-up"); 
                              }else{
                                 document.getElementById("{{'Abrir_'.$estacionamento['id']}}").childNodes[0].classList.toggle("bi-arrow-up");
                                 document.getElementById("{{'Abrir_'.$estacionamento['id']}}").childNodes[0].classList.toggle("bi-arrow-down"); 
                              }
                              document.getElementById("{{'card_body_'.$estacionamento['id']}}").classList.toggle("hidden");
                           })
                        </script>
                        <div id="{{'card_body_'.$estacionamento['id']}}" class="card-body hidden">
                           @if(empty($estacionamento['vagas']) != true)
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th scope="col">ID</th>
                                       <th scope="col">MODELO</th>
                                       <th scope="col"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($estacionamento['vagas'] as $vaga)
                                          <tr>
                                             <td>{{$vaga['carro']['id']}} </td>
                                             <td>{{$vaga['carro']['modelo']}}</td>
                                             <td>
                                                <button wire:click="retirada({{$vaga['id']}})" class="btn btn-outline-danger">RETIRAR</button>
                                             </td>
                                          </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           @else
                              Este estacionamento não possui carros estacionados...
                           @endif
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
   {{--Mensagens--}}
   @include('layouts.components.alerts')

   @if($id != null)
      <script>
         document.getElementById("{{'card_body_'.$id}}").classList.toggle("hidden");
      </script>
   @endif
</div>
