<div class="container-fluid">
    <div class="row">
       <div class="col pt-2">
          <div class="card">
             <div class="card-header">
                CPF
             </div>
             <div class="card-body">
                <form method="post" wire:submit.prevent="update">
                   <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control  @error('cpf') is-invalid @enderror" placeholder="cpf" id="cpf" name="cpf" wire:model.defer="cpf">
                                <label for="cpf">CPF</label>
                                @error('cpf') 
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
                    @if(Session::has('message'))
                        {{Session::get('message') }}
                    @endif  
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>
