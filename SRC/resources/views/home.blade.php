@extends('app')

@section('content')
<center>
 <!-- <img style="height:auto; width:auto; max-width:400px; alt="" src="./pictures/homePic/bienvenue.png"> -->
<nav>
<form class="form-inline navbar-right">
  <div class="form-group">
  <img alt="" src="./pictures/homePic/search.png">
    <div class="input-group">
      	<input type="text" class="form-control" placeholder="Rechercher un Référant">
    </div>
  </div>
</form>
</nav>
<br>
<br>

<div  style="margin-left: 200px, margin-right: 200px" id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  
  <!-- indicateur, à incrementé en fonction du nombre d'images -->
  <ol class="carousel-indicators">
    @foreach ($referent as $ref)
     @if ($ref -> id == $referent[0] -> id) 
     	<li data-target="#carousel-example-generic" data-slide-to="{{ $ref -> id }}" class='active' ></li>
     @else
    	<li data-target="#carousel-example-generic" data-slide-to="{{ $ref -> id }} "></li>
    @endif
    @endforeach 
  </ol>

  <!-- Parametres des images  -->
  <div class="carousel-inner" role="listbox"> 
	@foreach ($referent as $ref)
		@if ($ref -> id == $referent[0] -> id)
    	<div class="item active">
    	@else
    	<div class="item">
    	@endif
    		<br>
     		<a href="/referents/vive.linux/games"><img style="border: 7px solid white; box-shadow: 0px 0px 3px black; max-height: 350px;" src="{{$ref -> image}}" width="300px"  alt="{{ $ref -> name }}-Nom"></a> 	
    		<div class="well well-lg col-xs-4 col-md-2">{{$ref -> firstname}}, {{$ref -> lastname}}</div>
    	</div> 
	@endforeach
	</div>
	
  	<!-- Controles -->
  	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    	<span class="sr-only">Précédant</span>
  	</a>
  	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    	<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    	<span class="sr-only">Suivant</span>
  	</a>
</div>

<script type="text/javascript">
document.oncontextmenu = new Function("return false");
</script>

-->
</center>
@endsection
