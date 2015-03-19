@extends('frontend/template')

@section('content')

<div class="abso referents">
<div class="game active"
         onclick='location.href = "{{ URL::to('puzzle') }}";'
         style="background:url('{{ URL::to('imgs/puzzle/puzzle.png') }}'); width: 50%;">
    </div>
<br>
    <button class="level" onclick="location.href='{{ URL::to('puzzle/jouer/1') }}'"><span style="color:gold;"><span class="icon-star-full"></span></span><span class="icon-star-full"></span><span class="icon-star-full"></span></button>
    

    
    <button  class="level" onclick="location.href='{{ URL::to('puzzle/jouer/2') }}'"><span style="color:gold;"><span class="icon-star-full"></span><span class="icon-star-full"></span></span><span class="icon-star-full"></span></button>
    
<button class="level" onclick="location.href='{{ URL::to('puzzle/jouer/3') }}'"><span style="color:gold;"><span class="icon-star-full"></span><span class="icon-star-full"></span><span class="icon-star-full"></span></span></button>
</div>

<div style="position: relative; left: 0; bottom:-10%; padding-left:1%; ">
    <a href="/"><img style="height: 80px;" src="{{ URL::to('imgs/previouspage.png') }}"></a>
</div>

@section('page-css')
<link href="{{ URL::to('css/fonts/style.css') }}" rel="stylesheet" type="text/css"/>
@endsection