<div class="">
    <div class="row">
        <div class="col pt-2">
          <div class="card">
             <div class="card-header">
                Empresa
             </div>
             <div class="card-body">
                <form method="post" wire:submit.prevent="update">
                   <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control  @error('cnpj') is-invalid @enderror" placeholder="cnpj" id="cnpj" name="cnpj" wire:model.defer="cnpj">
                                <label for="cnpj">CNPJ</label>
                                @error('cnpj') 
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                   </div>
                    <div class="row pt-2 d-flex align-items-center">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-outline-dark mb-2">
                                Salvar
                            </button>
                        </div>
                    </div>
                </form>
             </div>
          </div>
       </div>
    </div>

    {{--Mensagens--}}
    @include('layouts.components.alerts')
    
 </div>
