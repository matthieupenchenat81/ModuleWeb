@extends('frontend/template')

@section('page-css')
<link rel="stylesheet" href="/css/memory.css">
@endsection

@section('content')

<div style="margin:auto;width:90%">
    <div id="my-memory-game"></div>
</div>
@endsection

@section('page-scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="/js/classList.min.js"></script>
<script src="/js/memory.js"></script>
<script>
    
    
    (function(){
			var myMem = new Memory({
				wrapperID : "my-memory-game",
				cards : [
					{
						id : 1,
						img: "/pictures/default/monsters-01.png"
					},
					{
						id : 2,
						img: "/pictures/default/monsters-02.png"
					},
					{
						id : 3,
						img: "/pictures/default/monsters-03.png"
					},
					{
						id : 4,
						img: "/pictures/default/monsters-04.png"
					},
					{
						id : 5,
						img: "/pictures/default/monsters-05.png"
					},
					{
						id : 6,
						img: "/pictures/default/monsters-06.png"
					},
					{
						id : 7,
						img: "/pictures/default/monsters-07.png"
					},
					{
						id : 8,
						img: "/pictures/default/monsters-08.png"
					},
					{
						id : 9,
						img: "/pictures/default/monsters-09.png"
					},
					{
						id : 10,
						img: "/pictures/default/monsters-10.png"
					},
					{
						id : 11,
						img: "/pictures/default/monsters-11.png"
					},
					{
						id : 12,
						img: "/pictures/default/monsters-12.png"
					},
					{
						id : 13,
						img: "/pictures/default/monsters-13.png"
					},
					{
						id : 14,
						img: "/pictures/default/monsters-14.png"
					},
					{
						id : 15,
						img: "/pictures/default/monsters-15.png"
					},
					{
						id : 16,
						img: "/pictures/default/monsters-16.png"
					}
				],
				onGameStart : function() { return false; },
				onGameEnd : function() { return false; }
			});
		})();
    
</script>
@endsection