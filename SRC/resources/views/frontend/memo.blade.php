@extends('frontend/template')

@section('page-css')
<link rel="stylesheet" href="/css/memory.css">
<link rel="stylesheet" href="/css/fonts/style.css" type="text/css">

<style>
    .mg__tile--inside {
        background-size: cover;
    }

</style>
@endsection

@section('content')
<div style="position: fixed; left: 0;top:0;">
    <a href="/"><img style="height: 50px; width:50px;" src="{{ URL::to('imgs/previouspage.png') }}"></a>
</div>
<div id="my-memory-game"></div>
@endsection

@section('page-scripts')
<script src="/js/firework.js"></script>

<!--<script src="/js/fire-work.js"></script>-->

<script src="/js/memory.js"></script>

<script>

    var cards2 = [];
    @foreach($oeuvres as $o)
    cards2.push(
        {
            id : '{{$o->id}}',
            img : 'http://www.augustins.org/documents/10180/156407/{{ $o->image}}'
        }
    );
    @endforeach

    var myMem = new Memory({
        wrapperID : "my-memory-game",
        cards : cards2,
        onGameStart : function() { return false; },
        onGameEnd : function() { return false; }
    }, {{$niveau}}, {{$nbBloc}},{{$nbPartie}} );


</script>

@endsection
