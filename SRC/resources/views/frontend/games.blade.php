
@extends('frontend/template')

@section('content')
    <div style="text-align:center">
        
        <div id="imgRef" style="background-image:url('{{ $ref -> image }}');">
        </div>
        <br>
        
        
        <div class="game" onclick="location.href='{{ URL::to('memo') }}'"><img src="imgs/memo/memo2.png"></div>
        <div class="game" onclick="location.href='{{ URL::to('puzzle') }}'"><img src="imgs/puzzle/puzzle.png"></div> 
            
        <br>
        <div style="display:inline-block;">
            <img style="height:100px; vertical-align:middle;width:100px" src="{{ URL::to('imgs/trophees/bronze.png') }}"><br>
            <div class="trophy-text" style="color:chocolate;">{{$nbBronze}}</div>

        </div>
        <div style="display:inline-block;">
            <img style="height:100px; vertical-align:middle;width:100px" src="{{ URL::to('imgs/trophees/argent.png') }}"><br>
            <div class="trophy-text" style="color:#c0c0c0;">{{$nbArgent}}</div>

        </div>
        <div style="display:inline-block;">
            <img style="height:100px; vertical-align:middle;width:100px" src="{{ URL::to('imgs/trophees/or.png') }}"><br>
            <div class="trophy-text" style="color:gold;">{{$nbOr}}</div>

        </div>
    </div>
@endsection

@section('page-scripts')
<script>

    var redirectTimer;


    imgRef.innerHTML = '&nbsp;';


    function absorbEvent_(event) {
        var e = event || window.event;
        e.preventDefault && e.preventDefault();
        e.stopPropagation && e.stopPropagation();
        e.cancelBubble = true;
        e.returnValue = false;
        return false;
    }

    function startCounter(event) {
        absorbEvent_(event);
        imgRef.innerHTML = 3;
        redirectTimer = setInterval(counter, 1000);
    }

    function counter() {
            imgRef.innerHTML--;
            if(imgRef.innerHTML == 0) location.href="{{URL::to('choisirref')}}";
    }

    function endCounter(event) {
        imgRef.innerHTML = '&nbsp;';
        clearInterval(redirectTimer);
    }

    document.getElementById('imgRef').addEventListener("mousedown", startCounter);
    document.getElementById('imgRef').addEventListener("touchstart", startCounter);
    window.addEventListener("mouseup", endCounter);
    window.addEventListener("touchend", endCounter);
       
</script>
@endsection
