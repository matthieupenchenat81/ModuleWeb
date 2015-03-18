
@extends('frontend/template')

@section('content')
    <div style="text-align:center">
        
        <div id="imgRef" style="background-image:url('{{ $ref -> image }}');"></div><br>
        
        
        <div class="game" onclick="location.href='{{ URL::to('memo') }}'"><img src="imgs/memo/memo2.png"></div>
        <div class="game" onclick="location.href='{{ URL::to('puzzle') }}'"><img src="imgs/puzzle/puzzle.png"></div> 
            
        
        <div style="line-height:50px;"><img style="height:50px; vertical-align:middle;width:50px" src="{{ URL::to('imgs/trophees/or.png') }}"><span style="vertical-align:middle;font-size:20px">1</span>

    <img style="height:50px; vertical-align:middle;width:50px" src="{{ URL::to('imgs/trophees/or.png') }}"><span style="vertical-align:middle;font-size:20px">2</span>

    <img style="height:50px; vertical-align:middle;width:50px" src="{{ URL::to('imgs/trophees/or.png') }}"><span style="vertical-align:middle;font-size:20px">4</span>
    </div>
    </div>
@endsection

@section('page-scripts')
<script>
    var redirect;
    
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
        redirect = setTimeout(function(){location.href="{{URL::to('choisirref')}}"}, 3000);
        return false;
        
    });   
    document.getElementById('imgRef').addEventListener("mouseup", function() {
        clearTimeout(redirect);
        return false;
    });
    
    
    document.getElementById('imgRef').addEventListener("touchstart", function(event) {
        absorbEvent_(event);
        redirect = setTimeout(function(){location.href="{{URL::to('choisirref')}}"}, 3000);
        return false;
    });    

    document.getElementById('imgRef').addEventListener("touchend", function() {
        clearTimeout(redirect);
        return false;
    });   
</script>
@endsection
