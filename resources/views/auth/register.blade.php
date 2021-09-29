<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-floating">
                {{--<x-jet-label for="name" value="{{ __('Name') }}" />--}}
                <x-jet-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <label for="name" value="{{ __('Nome') }}">Nome</label>
            </div>

            <div class="form-floating mt-4">
                {{--<x-jet-label for="email" value="{{ __('Email') }}" />--}}
                <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
                <label for="email" value="{{ __('email') }}">Email</label>
            </div>

            <div class="form-floating mt-4">
                {{--<x-jet-label for="password" value="{{ __('Password') }}" />--}}
                <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                <label for="password" value="{{ __('password') }}">Senha</label>
            </div>

            <div class="form-floating mt-4">
                {{--<x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />--}}
                <x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                <label for="password_confirmation" value="{{ __('password_confirmation') }}">Confirmação de Senha</label>
            </div>

            <div class="mt-4">
                <label for="roles" >Esta conta será destinada para?</label>
                <select name="roles" id="roles" class="form-select block w-full mt-1">
                    <option value="1">Empresas</option>
                    <option value="2">Pessoas</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Já registrado?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Registar') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
