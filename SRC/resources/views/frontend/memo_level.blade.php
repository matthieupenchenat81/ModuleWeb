@extends('frontend/template')

@section('content')

<div class="referents">
<div class="referent game"
         onclick='location.href = "{{ URL::to('memo') }}";'
         style="background:url('{{ URL::to('imgs/memo.jpg') }}'); width: 50%;">
        <div class="infos">Mémo</div>
    </div>
    
    <br>
    <button onclick="location.href='{{ URL::to('memo/jouer/1') }}'"><span style="color:gold;"><span class="icon-star-full"></span></span><span class="icon-star-full"></span><span class="icon-star-full"></span></button>

<button  onclick="location.href='{{ URL::to('memo/jouer/2') }}'"><span style="color:gold;"><span class="icon-star-full"></span><span class="icon-star-full"></span></span><span class="icon-star-full"></span></button>

<button  onclick="location.href='{{ URL::to('memo/jouer/3') }}'"><span style="color:gold;"><span class="icon-star-full"></span><span class="icon-star-full"></span><span class="icon-star-full"></span></span></button><br>
    
    <div style="line-height:50px;"></div><img style="height:50px; vertical-align:middle;width:50px" src="{{ URL::to('imgs/trophees/or.png') }}"><span style="vertical-align:middle;font-size:20px">{{ $nbOr }}</span>
        
    <img style="height:50px; vertical-align:middle;width:50px" src="{{ URL::to('imgs/trophees/or.png') }}"><span style="vertical-align:middle;font-size:20px">{{ $nbOr }}</span>
    
    <img style="height:50px; vertical-align:middle;width:50px" src="{{ URL::to('imgs/trophees/or.png') }}"><span style="vertical-align:middle;font-size:20px">{{ $nbOr }}</span>
    </div>


</div>


@section('page-css')
<link href="{{ URL::to('css/fonts/style.css') }}" rel="stylesheet" type="text/css"/>
@endsection