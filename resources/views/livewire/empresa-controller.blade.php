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
                CNPJ
             </div>
             <div class="card-body">
                <form method="post" wire:submit.prevent="update">
                   <div class="row">
                        <div class="col-md-4">
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
                            <button type="submit" class="btn btn-outline-secondary mb-2">
                                Salvar
                            </button>
                        </div>
                    </div>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>