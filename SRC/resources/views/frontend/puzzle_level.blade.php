@extends('frontend/template')

@section('content')
<div class="referents">
	<div class="game no-click"
         style="background:url('{{ URL::to('imgs/puzzle/puzzle.png') }}'); background-repeat:no-repeat; background-size: contain; border: none; margin-top: 10%;">
    </div>
	<br>
    <button class="level" onclick="location.href='{{ URL::to('puzzle/jouer/1') }}'">
    	<span style="color:gold;">
    		<span class="icon-star-full"></span>
    	</span>
    	<span class="icon-star-full"></span>
    	<span class="icon-star-full"></span>
    </button>

    <button  class="level" onclick="location.href='{{ URL::to('puzzle/jouer/2') }}'"><span style="color:gold;"><span class="icon-star-full"></span><span class="icon-star-full"></span></span><span class="icon-star-full"></span></button>
    
	<button class="level" onclick="location.href='{{ URL::to('puzzle/jouer/3') }}'"><span style="color:gold;"><span class="icon-star-full"></span><span class="icon-star-full"></span><span class="icon-star-full"></span></span></button>
</div>

<div style="position: relative; left: 0; bottom: 400px; padding-left:1%; ">
    <a href="/"><img style="height: 80px;" src="{{ URL::to('imgs/previouspage.png') }}"/></a>
</div>
@endsection

@section('page-css')
<link href="{{ URL::to('css/fonts/style.css') }}" rel="stylesheet" type="text/css"/>
@endsection