<x-jet-form-section submit="PessoaController">
    <x-slot name="title">
        {{ __('Informações Adicionais') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Altere suas informações') }}
    </x-slot>

    <x-slot name="form">
        <div  wire:poll.visible class="col-span-6 sm:col-span-4">
            <x-jet-label for="cpf" value="{{ __('Cpf') }}" />
            <x-jet-input id="cpf" type="text" class="mt-1 block w-full" wire:model.defer="update" value="{{$user->cpf}}"/>
            <input type="text" name="" id="" value="{{$user->cpf}}">
            <x-jet-input-error for="cpf" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Salvo.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Salvar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
