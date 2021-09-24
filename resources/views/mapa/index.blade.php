<x-app-layout>
     
    <div>
        @if(Session::has('error'))
            {{Session::get('error') }} <br>
        @endif
    
        @if(Session::has('success'))
            {{Session::get('success')}} <br>
        @endif
    </div>  
    

    <div id="mapa" class="mapa"> 
        {!!Mapper::render()!!}
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById("mapa").style.height = document.getElementById("l-navbar").offsetHeight + "px"; 
        });
    </script>
</x-app-layout>
