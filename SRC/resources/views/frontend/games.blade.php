
@extends('frontend/template')

@section('content')
    <div style="text-align:center">
        
        <div id="imgRef" style="background-image:url('{{ $ref -> image }}');">
        	<span id="decompte"></span>
        </div>
        <br>
        
        
        <div class="game" onclick="location.href='{{ URL::to('memo') }}'"><img src="imgs/memo/memo2.png"></div>
        <div class="game" onclick="location.href='{{ URL::to('puzzle') }}'"><img src="imgs/puzzle/puzzle.png"></div> 
            
        <br>
        <div style="display:inline-block;">
            <img style="height:100px; vertical-align:middle;width:100px" src="{{ URL::to('imgs/trophees/bronze.png') }}"><br>
            {{$nbBronze}}
        </div>
        <div style="display:inline-block;">
            <img style="height:100px; vertical-align:middle;width:100px" src="{{ URL::to('imgs/trophees/argent.png') }}"><br>
            {{$nbArgent}}
        </div>
        <div style="display:inline-block;">
            <img style="height:100px; vertical-align:middle;width:100px" src="{{ URL::to('imgs/trophees/or.png') }}"><br>
            {{$nbOr}}
        </div>
    </div>
@endsection

@section('page-scripts')
<script>
    var redirect;
    var i = 3;
    
    function decompte() {	
    	//on affiche i secondes
     	document.getElementById("decompte").innerHTML = i.toString()+" secondes"; 
     	if (i == 0) 
     	{
     		document.getElementById("decompte").innerHTML = "Redirection..."; // quand i atteint 0 on affiche redirection 
     		location.href="{{URL::to('choisirref')}}"; // on redirige
     	 	clearInterval(timer); // on stop le timer 
     	 } 
     	i = i - 1; //on decremente  
   	}
    
    function absorbEvent_(event) {
        var e = event || window.event;
        e.preventDefault && e.preventDefault();
        e.stopPropagation && e.stopPropagation();
        e.cancelBubble = true;
        e.returnValue = false;
        return false;
    }
    
    document.getElementById('imgRef').addEventListener("click", function(event) {
        absorbEvent_(event);
        return false;
    });
    
    
   
    document.getElementById('imgRef').addEventListener("mousedown", function(event) {
        absorbEvent_(event);
        var timer = setInterval(function(){ decompte() } , 1000); //intervalle, decompte de 1 secondes
        //redirect = setTimeout(function(){location.href="{{URL::to('choisirref')}}"}, 3000);
        return false;
        
    });   
    
    document.getElementById('imgRef').addEventListener("mouseup", function() {
        clearTimeout(redirect);
        clearInterval(timer); // on stop le decompte si on relache la souris
        return false;
    });
    
    
    document.getElementById('imgRef').addEventListener("touchstart", function(event) {
        absorbEvent_(event);
        //redirect = setTimeout(function(){location.href="{{URL::to('choisirref')}}"}, 3000);
        return false;
    });   

    document.getElementById('imgRef').addEventListener("touchend", function() {
        clearTimeout(redirect);
        return false;
    });   
</script>
@endsection
