@extends('app')

@section('content')

  <br>
  <div class="col-md-2"></div>

   <div class="col-md-8">
    <button style="float: right" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Ajouter un référent</button>
    <br><br>
    <table class="table table-hover table-bordered">
      <thead>
        <tr style="background-color: #F7BE81">
          <td>Nom</td>
          <td>Mail</td>
          <td>Lieu</td>
          <td>Se connecter</td>
          <td>Supprimer</td>
        </tr>
      </thead>
      <tbody>
      @foreach ($users as $user)
        <tr style="background-color: #F6E3CE">
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>Toulouse</td>
          <td><a href="#" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-log-in"></span></a></td>
          <td><a href="#" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
      @endforeach
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
      <form class="form-horizontal" method="POST" role="form" action="addUser">
      <div class="modal-body">
            <div class="form-group">
              <label for="firstname" class="col-sm-2 control-label">Prénom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom">
              </div>
            </div>
            <div class="form-group">
              <label for="lastname" class="col-sm-2 control-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="lastname" placeholder="Nom">
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label for="city" class="col-sm-2 control-label">Ville</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="city" placeholder="Ville">
              </div>
            </div>
          

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary">Enregistrer</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
