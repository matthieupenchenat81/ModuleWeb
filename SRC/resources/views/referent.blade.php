@extends('app')

@section('content')
<link href="css/referent.css" rel="stylesheet" type="text/css"/>
<br>
<!-- Navbar left -->
<div class="col-md-3 listg">
	<legend>Créer une liste oeuvre:</legend>
	<form class="form-inline" method="POST" role="form" action="addListeOeuvre">
  		<input type="hidden" name="idUser" value="{{ $me->id }}">
  		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
  		<div class="form-group">
    		<div class="input-group">
      			<input type="text" class="form-control" required="required" name="name" placeholder="Ajouter une liste d'oeuvre">
    		</div>
 		</div>
  		<button type="submit" class="btn btn-primary">Ajouter</button>
	</form>
	<br><br>
	<legend>Mes listes d'oeuvres:</legend>
	<table class="table table-hover">
	<caption>Nom  | Activer | Supprimer</caption>
 	@foreach ($listeoeuvres as $listeoeuvre)
		<tr class="active listeoeuvre">
    		<form method="POST" role="form" action="deleteListeOeuvre">
    			<input type="hidden" name="idUser" value="{{ $me->id }}">
    			<input type="hidden" class="idListeOeuvre" name="idListeOeuvre" value="{{ $listeoeuvre->id }}">
    			<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<td>{{$listeoeuvre->nom}}</td>
				<td>
					<label class="ios7-switch">
    				<input type="checkbox" checked>
    				<span></span>
    				</label>
    			</td>
				<td>
					<button type="submit" class="btn btn-sm btn-danger">
					<span class="glyphicon glyphicon-trash"></span></a>
				</td>
			</form>
		</tr>
	@endforeach
	</table>
</div>


<div class="col-md-8 princ">
	<!-- switch a rajouté -->
  <legend>Falbala: </legend>

  <div class="panel panel-default col-md-9"><br>
    <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="#">Ma sélection</a></li>
      <li role="presentation"><a href="#">Ajouter des images</a></li>
    </ul>
    <br><br><br><br><br><br><br><br><br><br><br><br>
  </div>

  <div class="col-md-3">
  <legend>Mes jeux associés</legend>
  
    <div class="checkbox">
    	<label class="ios7-switch">
    		<input type="checkbox" checked>
    		<span></span>
    		Puzzle Game
		</label>

    	<label class="ios7-switch">
    		<input type="checkbox" >
    		<span></span>
    		Jeu du pendu
		</label>

    	<label class="ios7-switch">
    		<input type="checkbox" >
    		<span></span>
    		Assassin's creed
		</label>
    </div>
    
  </div>
  <br><br><br>
</div>


<div class="col-md-8 listRecherche">

    <div class="col-md-9">
    	
      <span style="float: right"><a href="">Sélectionner tout</a> -- <a href="">Annuler sélection</a></span><br>
      <div class="panel panel-default">
        <div class="panel-body" id="oeuvrePic">
      <!-- // TODO -->
        </div>
      </div>
      <button style="float: right" class="btn btn-primary" id="enregistrer">Enregistrer</button>
    </div>
</div>


<div class="col-md-8 filtred">
	<div> 
    	<legend>Critères</legend>
    	<select class="form-control comboSearch">
      		<option selected="selected">Selectionner catégorie</option>
      		<option>1</option>
      			<option>2</option>
    		</select>
    		<select class="form-control comboSearch">
      			<option selected="selected">Tous les éléments</option>
      			<option>1</option>
      			<option>2</option>
    		</select>
    		<button style="margin-top: 5px" class="btn btn-primary">Ajouter</button>

    		
	</div>
	
    <form class="form-inline">
    	<legend>Mes filtres</legend>
  		<table class="table">
    		<tr>
      			<td>Montagne: noire</td>
      			<td>Supprimer</td>
    		</tr>
    		<tr>
     			<td>couleur: bleu</td>
      			<td>Supprimer</td>
    		</tr>
   			<tr>
      			<td>âge: 10 ans</td>
      			<td>Supprimer</td>
    		</tr>
  		</table>
  	</form>
</div>

@endsection

