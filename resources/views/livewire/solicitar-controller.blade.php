<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col pt-2">
                <div class="card">
                    <div class="card-header">
                        Solicitar Vaga
                    </div>
                    <div class="card-body">
                        <form method="post" wire:submit.prevent="solicitar">
                            <div class="row">
                                <div class="col-md-6 pb-1">
                                    <select class="form-select" aria-label="carros" wire:model="carro">
                                        <option value=''>Selecione...</option>
                                        @foreach ($carros as $carro)
                                            <option value="{{(int)$carro->id}}">{{$carro->modelo ." - ". $carro->ano}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 pb-1">
                                    <select  id="selectEstacionamento" class="form-select" aria-label="estacionamento" wire:model="estacionamento">
                                        <option value="">Selecione...</option>
                                        @foreach ($estacionamentos as $estacionamento)
                                            <option value="{{(int)$estacionamento->id}}">{{$estacionamento->fantasia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row pt-2 d-flex align-items-center">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-outline-secondary mb-2">
                                        Cadastrar
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
                    <div class="card-header">
                        Seus Carros
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                               <tr>
                                  <th scope="col">CARRO</th>
                                  <th scope="col">LOCAL</th>
                                  <th scope="col"></th>
                               </tr>
                            </thead>
                            <tbody>
                               @foreach ($vagas as $vaga)
                                  <tr>
                                    <td>{{ $vaga['carro']['modelo']}}</td>
                                    <td>{{$vaga['estacionamento']}}</td>
                                    <td>
                                        <button wire:click="retirada({{$vaga['id'].','.$vaga['carro']['id']}})"class="btn btn-outline-secondary">RETIRAR</button>
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

    {{--Mensagens--}}
    @include('layouts.components.alerts')

    <script>
        document.addEventListener('livewire:load', function () {
            @this.set('estacionamento', {{$id}});
        });
    </script>
</div>
