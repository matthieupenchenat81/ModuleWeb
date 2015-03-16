@extends('frontend/template')

@section('content')
    <div class="titreIcon">
    	<img src="imgs/games.png" />
    </div>
    <div class="text-center">
		<a href="{{ URL::to('puzzle') }}" ><img src="imgs/puzzle/iconPuzzle.png" alt="puzzle"/></a>
		<a href="{{ URL::to('memo') }}" ><img src="imgs/memo/memo.png" alt="memo"/></a>
    </div>
@endsection
