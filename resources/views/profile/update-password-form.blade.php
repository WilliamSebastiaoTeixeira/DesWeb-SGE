<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Altere sua Senha') }}
    </x-slot>

    <x-slot name="description">
        {{ __('') }}
    </x-slot>

    <x-slot name="form">
        <div class="row">
            <div class="col-md-4">
                <div class="form-floating">
                    {{--<x-jet-label for="current_password" value="{{ __('Current Password') }}" />--}}
                    <x-jet-input id="current_password" type="password" class="form-control" wire:model.defer="state.current_password" autocomplete="current-password" />
                    <x-jet-input-error for="current_password" class="mt-2" />
                    <label for="current_password" >Senha Atual</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-floating">
                    {{--<x-jet-label for="password" value="{{ __('New Password') }}" />--}}
                    <x-jet-input id="password" type="password" class="form-control" wire:model.defer="state.password" autocomplete="new-password" />
                    <x-jet-input-error for="password" class="mt-2" />
                    <label for="password" >Nova Senha</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-floating">
                    {{--<x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />--}}
                    <x-jet-input id="password_confirmation" type="password" class="form-control" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                    <x-jet-input-error for="password_confirmation" class="mt-2" />
                    <label for="password_confirmation" >Confirme sua Senha</label>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Salvar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
