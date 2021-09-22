<div class="l-navbar show" id="l-navbar">
    <nav class="nav">
        <div>
            <a href="{{route('dashboard')}}" class="nav-logo">
                <i class="bi bi-pin-map nav-logo-icon"></i>
                <span class="nav-logo-name">SGE</span>
            </a>
            
            <x-jet-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                <i class="bi bi-person-circle"></i> 
                Profile
            </x-jet-nav-link>

            @can('empresa_access')
                <x-jet-nav-link href="{{ route('tasks.index') }}" :active="request()->routeIs('tasks.*')">
                    <i class="bi bi-list-task"></i> 
                    Tasks
                </x-jet-nav-link>
            @endcan

            @can('pessoa_access')
                <x-jet-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                    <i class="bi bi-person-lines-fill"></i> 
                    Users
                </x-jet-nav-link>
            @endcan
        </div> 

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();"> 
                <i class='bi bi-door-open nav-icon'></i> 
                <span class="nav-name">Sair</span>
            </a>
        </form>
    </nav>
</div>