@extends('frontend/template')

@section('page-css')
<link rel="stylesheet" href="/css/memory.css">
<style>
    .mg__tile--inside {
        overflow: hidden;
    }
    .mg__tile--inside img {
        max-width: 100%;   
    }
    
</style>
@endsection

@section('content')

<div style="margin:auto;width:90%">
    <div id="my-memory-game"></div>
</div>
@endsection

@section('page-scripts')
<script src="/js/memory.js"></script>
<script>
    
    var cards2 = [];
    @foreach($oeuvres as $o)
    cards2.push(
        {
            id : '{{$o->id}}',
            img : 'http://www.augustins.org/documents/10180/156407/{{ $o->image}}'}
        );
    @endforeach

    var myMem = new Memory({
        wrapperID : "my-memory-game",
        cards : cards2,
        onGameStart : function() { return false; },
        onGameEnd : function() { return false; }
    });
		
    
</script>
@endsection