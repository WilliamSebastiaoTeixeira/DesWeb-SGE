<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e nós enviaremos um link de redefinição de senha que permitirá que você escolha uma nova.') }}

        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-floating">
                {{--<x-jet-label for="email" value="{{ __('Email') }}" />--}}
                <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                <label for="email" value="{{ __('Email') }}">Email</label>

            </div>

            <div class="d-flex justify-content-center mt-4">
                <x-jet-button>
                    {{ __('Solicitar Códido de Recuperação') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
