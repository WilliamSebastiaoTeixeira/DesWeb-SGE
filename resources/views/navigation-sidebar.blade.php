<div class="l-navbar show" id="l-navbar">
    <nav class="nav">
        <div>
            <a href="{{route('dashboard')}}" class="nav-logo">
                <i class="bi bi-pin-map nav-logo-icon"></i>
                <span class="nav-logo-name">SGE</span>
            </a>

            <x-jet-nav-link href="{{ route('mapa.index') }}" :active="request()->routeIs('mapa.*')">
                <i class="bi bi-map"></i>
                Mapa
            </x-jet-nav-link>

            @can('empresa_access')
                <x-jet-nav-link href="{{ route('gerencia') }}" :active="request()->routeIs('gerencia')">
                    <i class="bi bi-book"></i>                
                    Gerenciar
                </x-jet-nav-link>
            @endcan
        
            @can('empresa_access')
                <x-jet-nav-link href="{{ route('estacionamento') }}" :active="request()->routeIs('estacionamento')">
                    <i class="bi bi-building"></i>
                    Criar
                </x-jet-nav-link>
            @endcan

            @can('pessoa_access')
                <x-jet-nav-link href="{{ route('solicita')}}" :active="request()->routeIs('solicita')">
                    <i class="bi bi-truck"></i>
                    Solicitar
                </x-jet-nav-link>
            @endcan

            @can('pessoa_access')
                <x-jet-nav-link href="{{ route('carro')}}" :active="request()->routeIs('carro')">
                    <i class="bi bi-truck"></i>
                    Carros
                </x-jet-nav-link>
            @endcan

            <x-jet-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                <i class="bi bi-person-circle"></i> 
                Perfil
            </x-jet-nav-link>
        </div> 

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();"> 
                <i class='bi bi-door-open nav-icon-logout'></i> 
                <span class="nav-name">Sair</span>
            </a>
        </form>
    </nav>
</div>