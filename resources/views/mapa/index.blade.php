<x-app-layout>
    <div id="mapa" class="mapa"> 
        {!!Mapper::render()!!}
    </div>

    {{--Mensagens--}}
    @include('layouts.components.alerts')
    
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById("mapa").style.height = document.getElementById("l-navbar").offsetHeight + "px"; 
        });
    </script>
</x-app-layout>
