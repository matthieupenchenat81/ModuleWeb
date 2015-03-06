@extends('app')
@section('content')
<link href="css/home.css" rel="stylesheet" type="text/css"/>
<link href="css/coverflow.css" rel="stylesheet" type="text/css"/>
<br>
<center>
  <img style="height:auto; width:auto; max-width:100px;" alt="" src="./pictures/homePic/home.png"> 
<nav>
<form class="form-inline navbar">
  <div class="row divRecherche">
    <div class="col-xs-12">
      	<input class="form-control inpSear" placeholder="Rechercher un Référant" name="search" onchange="hideIcon(this);" type="text">
    </div>
  </div>
</form>
</nav>


@if ($referent != [])
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
     		<a href="/referents/vive.linux/games"><img class="imgRef" src="{{$ref -> image}}"  alt="{{ $ref -> firstname }}-{{ $ref -> lastname }}"></a> 	
    		<a href="/referents/vive.linux/games"><div class="well well-lg nomRef">{{$ref -> firstname}}, {{$ref -> lastname}}</div></a>
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
</div>
@else

blabla LOL

@endif

<script type="text/javascript">
document.oncontextmenu = new Function("return false");

function hideIcon(self) {
    self.style.backgroundImage = 'none';
}

</script>
</center>
@endsection
