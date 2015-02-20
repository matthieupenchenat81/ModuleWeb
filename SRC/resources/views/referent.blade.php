@extends('app')

@section('content')
<link href="css/referent.css" rel="stylesheet" type="text/css"/>
<br>
<!-- Navbar left -->
<div class="col-md-2 listg">
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
    <thead>
      <tr>
        <th>Nom</th><th>Action</th>
      </tr> 
    </thead>
    <tbody>
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
              <button type="submit" class="btn btn-sm btn-danger">
              <span class="glyphicon glyphicon-trash"></span></button>
            </td>
          </form>
        </tr>
      @endforeach
    </tbody>
	</table>
</div>


<div class="col-md-9 princ">
	<!-- switch a rajouté -->
  <legend>Falbala: </legend>

  <div class="panel panel-default col-md-9"><br>
    <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="#">Ma sélection</a></li>
      <li role="presentation"><a href="#">Ajouter des images</a></li>
    </ul>
    <br>

    <br><br><br><br><br><br><br><br><br><br><br>
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


<!-- TAKE ALL THAT'S INSIDE THIS DIV FOR "MY SELECTION" -->
<div class="col-md-7 princ" id="selection">
  <span style="float: right"><a href="">Sélectionner tout</a> -- <a href="">Annuler sélection</a></span><br>
    <div class="panel-body" id="oeuvrePic">
      <!-- // TODO -->
    </div>
  <button style="float: right" class="btn btn-primary" id="enregistrer">Enregistrer</button>
</div>


<!-- TAKE ALL THAT'S INSIDE THIS DIV FOR "ADD PICTURES" -->
<div class="col-md-7 princ" id="addpicture">


  <!-- PART CHOOSE AND FILL FILTER -->
  <legend>Recherche avancée</legend><br>
  <form class="form-horizontal">
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Auteur</label>
      <div class="col-sm-10">
        <select data-placeholder="Choisissez un auteur" class="chosen-select" multiple style="width:350px;" tabindex="4">
          <option value=""></option>
          <option value="United States">United States</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="Afghanistan">Afghanistan</option>
          <option value="Aland Islands">Aland Islands</option>
          <option value="Albania">Albania</option>
          <option value="Zambia">Zambia</option>
          <option value="Zimbabwe">Zimbabwe</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
      <div class="col-sm-10">
        <select data-placeholder="Choisissez une description" class="chosen-select" multiple style="width:350px;" tabindex="4">
          <option value=""></option>
          <option value="United States">United States</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="Afghanistan">Afghanistan</option>
          <option value="Aland Islands">Aland Islands</option>
          <option value="Albania">Albania</option>
          <option value="Zambia">Zambia</option>
          <option value="Zimbabwe">Zimbabwe</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Désignation</label>
      <div class="col-sm-10">
        <select data-placeholder="Choisissez une désignation" class="chosen-select" multiple style="width:350px;" tabindex="4">
          <option value=""></option>
          <option value="United States">United States</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="Afghanistan">Afghanistan</option>
          <option value="Aland Islands">Aland Islands</option>
          <option value="Albania">Albania</option>
          <option value="Zambia">Zambia</option>
          <option value="Zimbabwe">Zimbabwe</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Domaine</label>
      <div class="col-sm-10">
        <select data-placeholder="Choisissez un domaine" class="chosen-select" multiple style="width:350px;" tabindex="4">
          <option value=""></option>
          <option value="United States">United States</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="Afghanistan">Afghanistan</option>
          <option value="Aland Islands">Aland Islands</option>
          <option value="Albania">Albania</option>
          <option value="Zambia">Zambia</option>
          <option value="Zimbabwe">Zimbabwe</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Matière</label>
      <div class="col-sm-10">
        <select data-placeholder="Choisissez une matière" class="chosen-select" multiple style="width:350px;" tabindex="4">
          <option value=""></option>
          <option value="United States">United States</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="Afghanistan">Afghanistan</option>
          <option value="Aland Islands">Aland Islands</option>
          <option value="Albania">Albania</option>
          <option value="Zambia">Zambia</option>
          <option value="Zimbabwe">Zimbabwe</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Technique</label>
      <div class="col-sm-10">
        <select data-placeholder="Choisissez une technique" class="chosen-select" multiple style="width:350px;" tabindex="4">
          <option value=""></option>
          <option value="United States">United States</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="Afghanistan">Afghanistan</option>
          <option value="Aland Islands">Aland Islands</option>
          <option value="Albania">Albania</option>
          <option value="Zambia">Zambia</option>
          <option value="Zimbabwe">Zimbabwe</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Mot clé</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="exampleInputName2" placeholder="Mot clé">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Date Début</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="exampleInputName2" placeholder="date début">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Date Fin</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="exampleInputName2" placeholder="date fin">
      </div>
    </div>

    <center><button type="submit" class="btn btn-primary">Rechercher</button></center>
  </form>


  <br>
  <!-- PART RESULT OF MY SEARCH -->
  <legend>Résultat de ma recherche</legend>
  <span style="float: right"><a href="">Sélectionner tout</a> -- <a href="">Annuler sélection</a></span><br>
  <div class="panel panel-default">
    <div class="panel-body" id="oeuvrePic">

      <div class="col-xs-4 col-md-3">
        <a href="#" class="thumbnail">
        <img src="http://www.augustins.org/documents/10180/156407/1"/>
        </a>
      </div>
      <div class="col-xs-4 col-md-3">
        <a href="#" class="thumbnail">
        <img src="http://www.augustins.org/documents/10180/156407/1"/>
        </a>
      </div>
      <div class="col-xs-4 col-md-3">
        <a href="#" class="thumbnail">
        <img src="http://www.augustins.org/documents/10180/156407/1"/>
        </a>
      </div>

    </div>
  </div>
  <button style="float: right" class="btn btn-primary" id="enregistrer">Enregistrer</button>
</div>

@endsection

