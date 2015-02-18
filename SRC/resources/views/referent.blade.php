@extends('app')

@section('content')

<br>
<div class="col-md-3">

<legend>Créer une session:</legend>
<form class="form-inline">
  <div class="form-group">
    <div class="input-group">
      <input type="text" class="form-control" id="exampleInputAmount" placeholder="Ajouter une session">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Ajouter</button>
</form>

<br><br>
<legend>Mes sessions:</legend>
<table class="table table-hover">
  @foreach ($sessions as $session)
	<tr class="active">
		<td>{{$session->nom}}</td>
		<td>Supprimer</td>
	</tr>
  @endforeach
</table>

</div>


<div class="col-md-9">
<legend>Falbala: (Activer ou Désactiver la session)</legend>

<div class="col-md-9">

<span style="float: right">Sélectionner tout -- Annuler sélection</span><br>
<div class="panel panel-default">
  <div class="panel-body">
    
@foreach ($sessions[0]->oeuvres()->get() as $oeuvre)
  <div class="col-xs-4 col-md-3">
    <a href="#" class="thumbnail">
      <img src="http://www.augustins.org/documents/10180/156407/{{ $oeuvre->urlPhoto }}">
    </a>
  </div>
@endforeach

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
