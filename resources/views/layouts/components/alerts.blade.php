@if(Session::has('error'))
<div id="erroAlerta" class="position-fixed top-0 end-0 pt-3 pr-3" style="z-index: 9999;">
    <div wire:ignore class="flex justify-between text-orange-200 shadow-inner border-2 border-black p-2 bg-orange-600">
        <p class="self-center">{{Session::get('erroAlertar')}}</p>
        <button class="pl-1" id="alertclose">&times;</button>
    </div>
    <script>
        document.getElementById("alertclose").addEventListener("click", ()=>{
            document.getElementById("erroAlerta").remove();  
        })
    </script>
</div>
@endif

@if(Session::has('success'))
<div id="sucessoAlerta" class="position-fixed top-0 end-0 pt-3 pr-3" style="z-index: 9999">
    <div wire:ignore class="flex justify-between text-green-200 shadow-inner border-2 border-black p-2 bg-green-600">
        <p class="self-center"> {{Session::get('success')}}</p>
        <button class="pl-1" id="alertclose">&times;</button>
    </div>
    <script>
        document.getElementById("alertclose").addEventListener("click", ()=>{
            document.getElementById("sucessoAlerta").remove();  
        })
    </script>
</div>
@endif