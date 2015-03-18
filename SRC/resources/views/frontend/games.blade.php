
@extends('frontend/template')

@section('content')
    <div style="text-align:center">
        
        <div id="imgRef" style="background-image:url('{{ $ref -> image }}');"></div><br>
        
        
        <div class="game" onclick="location.href='{{ URL::to('memo') }}'"><img src="imgs/memo/memo2.png"></div>
        <div class="game" onclick="location.href='{{ URL::to('puzzle') }}'"><img src="imgs/puzzle/puzzle.png"></div> 
        
    </div>
@endsection

@section('page-scripts')
<script>
    var redirect;
    document.getElementById('imgRef').addEventListener("mousedown", function(event) {
        event.preventDefault();
        redirect = setTimeout(function(){location.href="{{URL::to('choisirref')}}"}, 3000);
        return false;
        
    });
    
    document.getElementById('imgRef').addEventListener("mouseup", function() {
        clearTimeout(redirect);
        return false;
    });
    
    
    
    
</script>
@endsection
