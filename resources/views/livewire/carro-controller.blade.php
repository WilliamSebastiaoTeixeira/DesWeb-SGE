
<div class="container-fluid">
    <div class="row">
        <div class="col pt-2">
            <div class="card">
                <div class="card-header">
                    <button id="abrirCriar" class="pr-3"><i class="bi bi-arrow-down"></i></button>
                    Cadastrar Carros
                </div>
                <div class="card-body">
                    <form method="post" wire:submit.prevent="criar">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('placa') is-invalid @enderror" placeholder="placa" id="placa" name="placa" wire:model="placa">
                                    <label for="cep1">Placa</label>
                                    @error('placa') 
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('modelo') is-invalid @enderror" id="modelo" name="modelo" wire:model="modelo" placeholder="Modelo">
                                    <label for="cep1">Modelo</label>
                                    @error('modelo') 
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('ano') is-invalid @enderror" id="ano" name="ano" wire:model="ano" placeholder="Ano">
                                    <label for="cep1">Ano</label>
                                    @error('ano') 
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2 d-flex align-items-center">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-outline-secondary mb-2">
                                    Inserir
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
       <div class="col pt-2">
          <div class="card">
             <div class="card-body">
                <table class="table">
                   <thead>
                      <tr>
                         <th scope="col">PLACA</th>
                         <th scope="col">MODELO</th>
                         <th scope="col">ANO</th>
                         <th scope="col"></th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($carros as $carro)
                         <tr>
                            <td>{{$carro->placa}} </td>
                            <td>{{$carro->modelo}}</td>
                            <td>{{$carro->ano}}</td>
                            <td>
                                <button wire:click="destroy({{ $carro->id }})"class="btn btn-outline-danger">Delete</button>
                            </td>
                         </tr>
                      @endforeach
                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>

    {{--Mensagens--}}
    @include('layouts.components.alerts')
    
    <script>
        document.addEventListener('livewire:load', function () {
            document.getElementById("abrirCriar").addEventListener("click",()=>{
                if(document.getElementById("abrirCriar").childNodes[0].classList[1] === "bi-arrow-down"){
                    document.getElementById("abrirCriar").childNodes[0].classList.toggle("bi-arrow-down");
                    document.getElementById("abrirCriar").childNodes[0].classList.toggle("bi-arrow-up"); 
                }else{
                    document.getElementById("abrirCriar").childNodes[0].classList.toggle("bi-arrow-up");
                    document.getElementById("abrirCriar").childNodes[0].classList.toggle("bi-arrow-down"); 
                }
                document.getElementById("bodyCriar").classList.toggle("hidden"); 
            })
        });
    </script>
 </div>