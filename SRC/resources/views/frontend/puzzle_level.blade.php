@extends('frontend/template')

@section('content')

<div class="trophees"></div>
<div class="abso referents">
<div class="referent game"
         onclick='location.href = "{{ URL::to('puzzle') }}";'
         style="background:url('{{ URL::to('imgs/puzzle.jpg') }}'); width: 50%;">
        <div class="infos">Puzzle</div>
    </div>
    
    <br>
    <button onclick="location.href='{{ URL::to('puzzle/jouer/1') }}'"><span style="color:gold;"><span class="icon-star-full"></span></span><span class="icon-star-full"></span><span class="icon-star-full"></span></button>
    
<br>
    
    
    <button  onclick="location.href='{{ URL::to('puzzle/jouer/2') }}'"><span style="color:gold;"><span class="icon-star-full"></span><span class="icon-star-full"></span></span><span class="icon-star-full"></span></button>
    
<br>
    <button onclick="location.href='{{ URL::to('puzzle/jouer/3') }}'"><span style="color:gold;"><span class="icon-star-full"></span><span class="icon-star-full"></span><span class="icon-star-full"></span></span></button>


</div>


@section('page-css')
<link href="{{ URL::to('css/fonts/style.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('page-scripts')
<script src="{{ URL::to('js/phaser.min.js') }}"></script>
    <script type="text/javascript">
        game = new Phaser.Game(222, 222, Phaser.CANVAS, '', { preload: preload, create: create }, true);
        function preload() {
            
        }function create() {
            
        }
    </script>
@endsection