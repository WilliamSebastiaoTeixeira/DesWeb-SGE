<x-app-layout>
    <x-slot name="header">
        <h2 class="">
            {{ __('Perfil') }}
        </h2>
    </x-slot>

    <div>
        <div class="container-fluid">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
            @endif

            <div class="">
                @can('pessoa_access')
                    @livewire('pessoa-controller')
                @endcan
                @can('empresa_access')
                    @livewire('empresa-controller')
                @endcan
            </div>
            
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="">
                    @livewire('profile.update-password-form')
                </div>
            @endif

            {{--
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif
            --}}
            {{--
            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>
            
            <x-jet-section-border />
            --}}

            {{--
            <div class="">
                @livewire('profile.delete-user-form')
            </div>
            --}}
        </div>
    </div>
</x-app-layout>
