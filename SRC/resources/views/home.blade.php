@extends('app')

@section('content')

<br>
<center><h1>Bienvenue!</h1>
<br>
<form class="form-inline">
  <div class="form-group">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Search</button>
</form>
<br>
<br>

<div  style="margin-left: 200px, margin-right: 200px" id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="./pictures/1.jpg" width="35%" alt="indians">
      <div class="carousel-caption">
        Ceci est une image
      </div>
    </div>
    <div class="item">
      <img src="./pictures/2.jpg" width="35%" alt="others indians">
      <div class="carousel-caption">
        Ceci est une image différente de l'autre
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="well well-lg">Information du référent</div>

</center>
@endsection
