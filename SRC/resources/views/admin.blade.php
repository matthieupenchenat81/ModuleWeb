@extends('app')

@section('content')

<<<<<<< HEAD
{{ Session::get('message_add') }}
{{ Session::get('message_delete') }}

=======
>>>>>>> baac10fe2346f5271d81bf13195da790a3f484f3
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
      <form method="POST" role="form" action="deleteUser">
        <input type="hidden" name="idUser" value="{{ $user->id }}">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <tr style="background-color: #F6E3CE">
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
<<<<<<< HEAD
          <td>{{$user->city}}</td>
          @if ($user->admin == 0)
            <td>Référent</td>
          @else
            <td>Admin</td>
          @endif
          <td><a href="#" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span></a></td>
          <td><button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
=======
          <td>Toulouse</td>
          <td><a href="#" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-log-in"></span></a></td>
          <td><a href="#" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
>>>>>>> baac10fe2346f5271d81bf13195da790a3f484f3
        </tr>
        </form>
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
                <input type="text" class="form-control" id="firstname" name="firstname" required placeholder="Prénom">
              </div>
            </div>
            <div class="form-group">
              <label for="lastname" class="col-sm-2 control-label">Nom</label>
              <div class="col-sm-10">
<<<<<<< HEAD
                <input type="text" class="form-control" id="lastname" name="lastname" required placeholder="Nom">
=======
                <input type="text" class="form-control" id="lastname" placeholder="Nom">
>>>>>>> baac10fe2346f5271d81bf13195da790a3f484f3
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
<<<<<<< HEAD
                <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
=======
                <input type="email" class="form-control" id="email" placeholder="Email">
>>>>>>> baac10fe2346f5271d81bf13195da790a3f484f3
              </div>
            </div>
            <div class="form-group">
              <label for="city" class="col-sm-2 control-label">Ville</label>
              <div class="col-sm-10">
<<<<<<< HEAD
                <input type="text" class="form-control" id="city" name="city" required placeholder="Ville">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input name="isadmin" type="checkbox"> Est administrateur
                  </label>
                </div>
=======
                <input type="text" class="form-control" id="city" placeholder="Ville">
>>>>>>> baac10fe2346f5271d81bf13195da790a3f484f3
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
