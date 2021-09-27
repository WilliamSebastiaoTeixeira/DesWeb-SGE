
<div class="container-fluid">
    <div class="row">
        <div class="col pt-2">
            <div class="card">
                <div class="card-header">
                    <button id="abrirCriar" class="pr-3"><i class="bi bi-arrow-down"></i></button>
                    Cadastrar Estacionamentos
                </div>
                <div wire:ignore id="bodyCriar" class="card-body hidden">
                    <form method="post" wire:submit.prevent="criar">
                        <div class="row">
                            <div class="col-md-6 pb-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('fantasia') is-invalid @enderror" placeholder="fantasia" id="fantasia" name="fantasia" wire:model.defer="fantasia">
                                    <label for="fantasia">Fantasia</label>
                                    @error('fantasia') 
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Selecione o local no mapa ou coloque as coordenadas geográficas
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 pb-2">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" wire:model.defer="latitude" placeholder="latitude">
                                                    <label for="latitude">Latitude</label>
                                                    @error('latitude') 
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 pb-2 ">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" wire:model.defer="longitude" placeholder="longitude">
                                                    <label for="longitude">longitude</label>
                                                    @error('longitude') 
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div wire:ignore class="row pt-2 d-flex align-items-center">
                                            <div id="mapa" class="mapa" style="height: 400px"> 
                                                {!!Mapper::render()!!}
                                            </div>
                                        </div>
                                    </div>
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
                         <th scope="col">Fantasia</th>
                         <th scope="col">Latitude</th>
                         <th scope="col">Longitude</th>
                         <th scope="col"></th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($estacionamentos as $estacionamento)
                         <tr>
                            <td>{{$estacionamento->fantasia}} </td>
                            <td>{{$estacionamento->latitude}}</td>
                            <td>{{$estacionamento->longitude}}</td>
                            <td>
                                <button wire:click="update({{ $estacionamento->id }})"class="btn btn-outline-primary p-1">Alterar</button>
                                <button wire:click="destroy({{ $estacionamento->id }})"class="btn btn-outline-danger p-1">Deletar</button>
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
            var latitude = document.getElementById("latitude"); 
            latitude.addEventListener("keyup", ()=> {
                @this.set('latitude', latitude.value);
            });
            var longitude = document.getElementById("longitude"); 
            longitude.addEventListener("keyup", ()=> {
                @this.set('longitude', longitude.value);
            });

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