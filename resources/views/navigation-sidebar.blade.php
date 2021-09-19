<div class="l-navbar show" id="l-navbar">
    <nav class="nav">
        <div>
            <a href="{{route('dashboard')}}" class="nav-logo">
                <i class="bi bi-pin-map nav-logo-icon"></i>
                <span class="nav-logo-name">SGE</span>
            </a>
            <div class="nav-list"> 
                
                <a href="/" class="nav-link">
                    <i class='bi bi-speedometer nav-icon'></i> 
                    <span class="nav-name">Gerencia</span> 
                </a>

                <a href="/" class="nav-link"> 
                    <i class='bi bi-percent nav-icon'></i> 
                    <span class="nav-name">Solicitar</span> 
                </a>

                @can('task_access')
                    <div class="nav-link">
                        <i class='bi bi-percent nav-icon'></i> 
                        <x-jet-nav-link href="{{ route('tasks.index') }}" :active="request()->routeIs('tasks.*')">
                            Tasks
                        </x-jet-nav-link>
                    </div>
                @endcan

            </div>
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