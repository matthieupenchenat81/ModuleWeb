@extends('app')

@section('content')
<link href="css/referent.css" rel="stylesheet" type="text/css"/>
<br>
<div class="col-md-3">

<legend>Créer une listeoeuvre:</legend>
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
  @foreach ($listeoeuvres as $listeoeuvre)
  <tr class="active listeoeuvre">
    <form method="POST" role="form" action="deleteListeOeuvre">
    <input type="hidden" name="idUser" value="{{ $me->id }}">
    <input type="hidden" class="idListeOeuvre" name="idListeOeuvre" value="{{ $listeoeuvre->id }}">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<td>{{$listeoeuvre->nom}}</td>
		<td><button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
	</tr>
  </form>
  @endforeach
</table>

</div>


<div class="col-md-9">


<div class="panel panel-default">
  <ul class="nav nav-tabs">
    <li role="presentation" class="active"><a href="#">Ma sélection</a></li>
    <li role="presentation"><a href="#">Ajouter des images</a></li>
  </ul>
  <br><br><br><br>
</div>

<br><br><br>

<legend>Falbala: (Activer ou Désactiver la listeoeuvre)</legend>

<div class="col-md-9">

<span style="float: right">Sélectionner tout -- Annuler sélection</span><br>
<div class="panel panel-default">
  <div class="panel-body" id="oeuvrePic">

<!-- // TODO -->

  <button style="float: right" class="btn btn-primary">Enregistrer</button>
  </div>
</div>

</div>


<div class="col-md-3">

<legend>Ajouter un filtre:</legend>
<h4>Par critère:</h4>
<select class="form-control">
  <option selected="selected">Selectionner catégorie</option>
  <option>1</option>
  <option>2</option>
</select>

<select class="form-control">
  <option selected="selected">Tous les éléments</option>
  <option>1</option>
  <option>2</option>
</select>
<button style="margin-top: 5px" class="btn btn-primary">Ajouter</button>
<br><br>

<h4>Par mot clé:</h4>
<form class="form-inline">
  <div class="col-sm-8 form-group">
    <div class="input-group">
      <input type="text" class="form-control" id="exampleInputAmount" placeholder="Par mot clé">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Ajouter</button>

<br><br>
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
</div>

</div>


@endsection

