
<div class="container-fluid">

    <div>
    @if(Session::has('error'))
        {{Session::get('error') }} <br>
    @endif

    @if(Session::has('success'))
        {{Session::get('success')}} <br>
    @endif
    </div>  

    <div class="row">
        <div class="col pt-2">
            <div class="card">
                <div class="card-header">
                    Cadastrar Estacionamentos
                </div>
                <div class="card-body">
                    <form method="post" wire:submit.prevent="criar">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('fantasia') is-invalid @enderror" placeholder="fantasia" id="fantasia" name="fantasia" wire:model="fantasia">
                                    <label for="fantasia">Fantasia</label>
                                    @error('fantasia') 
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" wire:model="latitude" placeholder="latitude">
                                    <label for="latitude">Latitude</label>
                                    @error('latitude') 
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" wire:model="longitude" placeholder="longitude">
                                    <label for="longitude">longitude</label>
                                    @error('longitude') 
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
                                <button wire:click="destroy({{ $estacionamento->id }})"class="btn btn-outline-danger">Deletar</button>
                            </td>
                         </tr>
                      @endforeach
                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
 </div>

 @livewireScripts
