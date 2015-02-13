@extends('app')

@section('content')
@extends('navbar_signed')

  <br>
  <div class="col-md-2"></div>

  <div class="col-md-8">
    <button style="float: right" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Ajouter un référent</button>
    <table class="table table-hover">
      <thead>
        <tr>
          <td>Nom</td>
          <td>Mail</td>
          <td>Lieu</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Quentin Rouland</td>
          <td>quentin.rouland@free.fr</td>
          <td>Toulouse</td>
          <td>
            <button type="button" class="btn btn-default btn-sm">Se connecter</button>
            <button type="button" class="btn btn-warning btn-sm">Supprimer</button>
          </td>
        </tr>
        <tr>
          <td>Quentin Rouland</td>
          <td>quentin.rouland@free.fr</td>
          <td>Toulouse</td>
          <td>
            <button type="button" class="btn btn-default btn-sm">Se connecter</button>
            <button type="button" class="btn btn-warning btn-sm">Supprimer</button>
          </td>
        </tr>
        <tr>
          <td>Quentin Rouland</td>
          <td>quentin.rouland@free.fr</td>
          <td>Toulouse</td>
          <td>
            <button type="button" class="btn btn-default btn-sm">Se connecter</button>
            <button type="button" class="btn btn-warning btn-sm">Supprimer</button>
          </td>
        </tr>
        <tr>
          <td>Quentin Rouland</td>
          <td>quentin.rouland@free.fr</td>
          <td>Toulouse</td>
          <td>
            <button type="button" class="btn btn-default btn-sm">Se connecter</button>
            <button type="button" class="btn btn-warning btn-sm">Supprimer</button>
          </td>
        </tr>
        <tr>
          <td>Quentin Rouland</td>
          <td>quentin.rouland@free.fr</td>
          <td>Toulouse</td>
          <td>
            <button type="button" class="btn btn-default btn-sm">Se connecter</button>
            <button type="button" class="btn btn-warning btn-sm">Supprimer</button>
          </td>
        </tr>
        <tr>
          <td>Quentin Rouland</td>
          <td>quentin.rouland@free.fr</td>
          <td>Toulouse</td>
          <td>
            <button type="button" class="btn btn-default btn-sm">Se connecter</button>
            <button type="button" class="btn btn-warning btn-sm">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Créer un nouvel adhérent</h4>
      </div>
      <div class="modal-body">

          <form class="form-horizontal">
            <div class="form-group">
              <label for="prenom" class="col-sm-2 control-label">Prénom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="prenom" placeholder="Prénom">
              </div>
            </div>
            <div class="form-group">
              <label for="nom" class="col-sm-2 control-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nom" placeholder="Nom">
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label for="ville" class="col-sm-2 control-label">Ville</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="ville" placeholder="Ville">
              </div>
            </div>
          </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary">Enregistrer</button>
      </div>
    </div>
  </div>
</div>



@endsection
