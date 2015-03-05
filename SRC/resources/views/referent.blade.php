@extends('app')

@section('content')
<link href="css/referent.css" rel="stylesheet" type="text/css"/>
<br>
<!-- Navbar left -->
<div class=" col-md-3">
<div class="listg">
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
    <thead class="tablethead">
      <tr>
        <th>Nom</th><th>Action</th><th>Supprimer</th>
      </tr> 
    </thead>
    <tbody>
      @foreach ($listeoeuvres as $index => $listeoeuvre)
        <tr class="listeoeuvre">
          <form method="POST" role="form" action="deleteListeOeuvre">
            <input type="hidden" name="idUser" value="{{ $me->id }}">
            <input type="hidden" class="idListeOeuvre" name="idListeOeuvre" value="{{ $listeoeuvre->id }}">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <td class="sessionName">{{$listeoeuvre->nom}}</td>
            <td>
            	<label class="ios7-switch">
                	<input class="activeSession" type="checkbox" checked>
                	<span></span>
              	</label>
            </td>
            <td>
              <button type="submit" class="btn btn-sm btn-danger">
              <span class="glyphicon glyphicon-trash"></span></button>
            </td>
          </form>
        </tr>
      @endforeach
    </tbody>
	</table>
</div>
</div>

<div class="col-md-9">
<div class="princ">
	<!-- switch a rajouté -->
  <legend id="sessionName"></legend>

  <div class="panel panel-default col-md-9"><br>
    <ul class="nav nav-tabs">
      <li role="presentation" class="active" id="liSelection"><a href="#">Ma sélection</a></li>
      <li role="presentation" id="liAddImages"><a href="#">Ajouter des images</a></li>
    </ul>
    <br>


<!-- TAKE ALL THAT'S INSIDE THIS DIV FOR "MY SELECTION" -->
<div id="selection">
  <span style="float: right"><a href="">Sélectionner tout</a> -- <a href="">Annuler sélection</a></span><br>
    <input type="hidden" id="_tokenRemoveFromSelection" name="_token" value="{{{ csrf_token() }}}" />
    <div class="panel-body" id="oeuvrePic">

        <!-- TODO -->

    </div>
    <!-- <button style="float: right" class="btn btn-primary" id="enregistrer">Enregistrer</button> -->
    <button type="button" style="float: right" class="btn btn-warning" id="removeFromSelection">Supprimer</button>
  <br><br>
</div>

<!-- TAKE ALL THAT'S INSIDE THIS DIV FOR "ADD PICTURES" -->
<div id="addpicture" style="display:none">


  <!-- PART CHOOSE AND FILL FILTER -->
  <legend>Recherche avancée</legend><br>
  <form class="form-horizontal" role="form" action="search" method="post">
    <input type="hidden" id="_tokenRes" name="_token" value="{{{ csrf_token() }}}" />
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Auteur</label>
      <div class="col-sm-10">
        <select data-placeholder="Choisissez un auteur" id="auteur" name="auteur[]" class="chosen-select" multiple tabindex="4">
          <option value=""></option>
          @foreach ($data['auteur'] as $val)
            <option value="{{$val -> id}}">{{$val -> nom}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Nom Oeuvre</label>
      <div class="col-sm-10">
        <select data-placeholder="Choisissez le nom d'une oeuvre" id="designation" name="designation[]" class="chosen-select" multiple tabindex="4">
          <option value=""></option>
          @foreach ($data['designation'] as $val)
            <option value="{{$val->id}}">{{$val->nom}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Domaine</label>
      <div class="col-sm-10">
        <select data-placeholder="Choisissez un domaine" id="domaine" name="domaine[]" class="chosen-select" multiple tabindex="4">
          <option value=""></option>
          @foreach ($data['domaine'] as $val)
            <option value="{{$val->id}}">{{$val->nom}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Matière</label>
      <div class="col-sm-10">
        <select data-placeholder="Choisissez une matière" id="matiere" name="matiere[]" class="chosen-select" multiple tabindex="4">
          <option value=""></option>
          @foreach ($data['matiere'] as $val)
            <option value="{{$val->id}}">{{$val->nom}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Technique</label>
      <div class="col-sm-10">
        <select data-placeholder="Choisissez une technique" id="technique" name="technique[]" class="chosen-select" multiple tabindex="4">
          <option value=""></option>
          @foreach ($data['technique'] as $val)
            <option value="{{$val->id}}">{{$val->nom}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Mot clé</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" name="motcle" disabled id="motcle" placeholder="Mot clé">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Date Début</label>
      <div class="col-sm-3">
        <input type="date" class="form-control" name="debut" id="debut" placeholder="date début">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Date Fin</label>
      <div class="col-sm-3">
        <input type="date" class="form-control" name="fin" id="fin" placeholder="date fin">
      </div>
    </div>

    <center><button type="button" class="btn btn-primary" id="search_button">Rechercher</button></center>
  </form>


  <br>
  <!-- PART RESULT OF MY SEARCH -->
  <legend>Résultat de ma recherche</legend>
  <span style="float: right"><a href="">Sélectionner tout</a> -- <a href="">Annuler sélection</a></span><br>
  <div class="panel panel-default">
    <div class="panel-body">
      <div id="oeuvreRes">
        <!-- TODO -->
      </div>
      <button style="float: right" type="button" class="btn btn-primary" id="addIntoMyList">Ajouter à ma liste d'oeuvre</button>
    </div>
  </div>
  <nav>
      <ul class="pager">
        <li class="previous disabled"><a id="previous" href=""><span aria-hidden="true">&larr;</span> Précédent</a></li>
        <li class="next disabled"><a id="next" href="">Suivant <span aria-hidden="true">&rarr;</span></a></li>
      </ul>
    </nav>
  <br><br>
</div>
  </div>

  <div class="col-md-3">
    <legend>Mes jeux associés</legend>
    @foreach($games as $game)
    <div class="checkbox">
      <input type="hidden" name="idGame" id="idGame" value="{{ $game->id }}">
    	<label class="ios7-switch">
    		<input id="checkbox{{$game->id}}" class="checkboxGame" type="checkbox">
    		<span></span>
    		 {{ $game->nom }}
		  </label>
    </div>
    @endforeach  
  </div>
  <br><br><br>
</div>
</div>
@endsection
