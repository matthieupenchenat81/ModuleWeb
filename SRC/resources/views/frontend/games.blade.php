@extends('frontend/template')

@section('content')
    <div class="referents">

    <div class="referent game"
         onclick='location.href = "{{ URL::to('puzzle') }}";'
         style="background:url('{{ URL::to('imgs/puzzle.jpg') }}'); width: 50%;">
        <div class="infos">Puzzle</div>
    </div>
    <div class="referent game"
         onclick='location.href = "{{ URL::to('memo') }}";'
         style="background:url('{{ URL::to('imgs/memo.jpg') }}'); width: 50%;">
        <div class="infos">Mémo</div>
    </div>
                
    </div>
@endsection
