<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Component;

class GerenciaController extends Component
{
    public function render()
    {
        abort_if(Gate::denies('empresa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('livewire.gerencia-controller');
    }
}
