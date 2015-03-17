
@extends('frontend/template')

@section('content')
    <div style="text-align:center">
        
        <div><img style="border-radius:50%; height:100px;width:100px;margin:40px;" src="{{ $ref -> image }}"></div>
        
        
        <div class="game"><img src="imgs/memo/memo2.png"></div>
       <div class="game"><img src="imgs/puzzle/puzzle.png"></div> 
        
    </div>
@endsection
