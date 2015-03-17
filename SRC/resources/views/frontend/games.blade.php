
@extends('frontend/template')

@section('content')
    <div style="text-align:center">
        
       <img id="imgRef" src="{{ $ref -> image }}"><br>
        
        
        <div class="game" onclick="location.href='{{ URL::to('memo') }}'"><img src="imgs/memo/memo2.png"></div>
       <div class="game" onclick="location.href='{{ URL::to('puzzle') }}'"><img src="imgs/puzzle/puzzle.png"></div> 
        
    </div>
@endsection

@section('page-scripts')
<script>
    var redirect;
    document.getElementById('imgRef').addEventListener("mousedown", function() {
        redirect = setTimeout(function(){location.href="{{URL::to('choisirref')}}"}, 3000);
        
    });
    
    document.getElementById('imgRef').addEventListener("mouseup", function() {
        clearTimeout(redirect);
    });
    
</script>
@endsection
