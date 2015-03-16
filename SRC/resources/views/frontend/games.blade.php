@extends('frontend/template')

@section('content')
    <div class="titreIcon">
    	<img src="imgs/games.png" />
    </div>
    <div id="back_ref">
    	<ul>
    		<li class="first">
    			<a href="/choisirref"><img src="{{ $ref -> image}}" style="border:1px solid silver;"/></a>
    			<span class="end">&nbsp;</span>
    		</li>
    		<li>
    			<span><img src="imgs/games.png" alt="game"/></span>
    			<span class="end">&nbsp;</span>
    		</li>
    	</ul>
    </div>
    <div class="text-center">
		<a href="{{ URL::to('puzzle') }}" ><img src="imgs/puzzle/iconPuzzle.png" alt="puzzle"/></a>
		<a href="{{ URL::to('memo') }}" ><img src="imgs/memo/memo2.png" alt="memo"/></a>
    </div>
    <footer>
    	<p style="text-align:center; color:black; font-size:12px; position:absolute; bottom: 0; "> Application du musée Augustin </p>
    </footer>
@endsection
