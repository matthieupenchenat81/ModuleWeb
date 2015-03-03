@extends('app')

@section('content')
<link href="css/admin.css" rel="stylesheet" type="text/css"/>

<div class="col-sm-12">
  @if (session('message_add'))
    <div class="alert alert-success col-sm-4">
      {{ Session::get('message_add') }}
    </div>
  @endif

  @if (session('message_delete'))
    <div class="alert alert-success col-sm-4">
      {{ Session::get('message_delete') }}
    </div>
  @endif
</div>

  <br>
  <div class="col-md-2"></div>

   <div class="col-md-8">
    <button type="button" class="btn btn-primary addRef" data-toggle="modal" data-target="#myModal">Ajouter un référent</button>
    <br><br>
    <!--  class="table table-hover table-bordered" -->
    <table>
      <thead>
        <tr style="background-color: #F7BE81">
          <td>Nom</td>
          <td>Prénom</td>
          <td>Mail</td>
          <td>Ecole</td>
          <td>Type</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
      @foreach ($users as $user)
        @if ($user->droits != 2 && $user != $me || ($user->droits != 0 && $me->droits == 2 && $user != $me))
        <tr style="background-color: #F6E3CE">
          <td>{{$user->lastname}}</td>
          <td>{{$user->firstname}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->school}}</td>
          @if ($user->droits == 0)
            <td>Référent</td>
          @else
            <td>Admin</td>
          @endif
          <td>
            &nbsp;&nbsp;
          @if ($user->droits == 0)
          <form method="POST" style = "float: left" role="form" action="logAs">
            <input type="hidden" name="idUser" value="{{ $user->id }}">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <button type="submit" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-log-in"></span></a>
          </form>
          @endif

          <form method="POST" role="form" style = "float: left" action="deleteUser">
            <input type="hidden" name="idUser" value="{{ $user->id }}">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <button type="submit" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
          </form>
        </div>
        </tr>
        @endif
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
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
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
                <input type="text" class="form-control" id="lastname" name="lastname" required placeholder="Nom">
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label for="city" class="col-sm-2 control-label">Ville</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="city" name="city" required placeholder="Ville">
              </div>
            </div>
            @if ($me->droits == 2)
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input name="isadmin" type="checkbox"> Est administrateur
                  </label>
                </div>
              </div>
            </div>
            @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
