@extends('backend/template')

@section('content')
   <div class="container" style="padding-top:60px">
       <div class="row"><div class="col-md-12">
  @if (session('message_add'))
    <div class="alert alert-success">
      {{ Session::get('message_add') }}
    </div>
  @endif

  @if (session('message_delete'))
    <div class="alert alert-danger">
      {{ Session::get('message_delete') }}
    </div>
  @endif
</div></div>

       <div class="panel panel-primary">
                <div class="panel-heading">Panel Administrateur<a class="btn btn-danger btn-xs pull-right" href="{{ URL::to('logout') }}">Se déconnecter</a></div>

                <div class="panel-body">
    <button type="button" class="btn btn-primary addRef" data-toggle="modal" data-target="#myModal">Ajouter un référent</button>
    <!--  class="table table-hover table-bordered" -->
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Etablissement</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      @foreach ($users as $user)
        <tr>
          <td>{{$user->nom}}</td>
          <td>{{$user->prenom}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->etablissement}}</td>
          <td>
              <div class="btn-group" role="group" aria-label="...">
                  <a href="{{ URL::to('admin/logAs', $user->id) }}" class="btn btn-primary"><span class="glyphicon glyphicon-zoom-in"></span></a>
                  <a href="{{ URL::to('admin/deleteUser', $user->id) }}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
              </div>
            </td>
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
      <form class="form-horizontal" method="POST" role="form" action="{{ URL::to('admin/addUser') }}">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      <div class="modal-body">
            <div class="form-group">
              <label for="firstname" class="col-sm-2 control-label">Prénom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" name="prenom" required placeholder="Prénom">
              </div>
            </div>
            <div class="form-group">
              <label for="lastname" class="col-sm-2 control-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="lastname" name="nom" required placeholder="Nom">
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
              </div>
            </div>
            <div class="form-group">
              <label for="city" class="col-sm-2 control-label">Etablissement</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="city" name="etablissement" required placeholder="Etablissement">
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>
      </form>
    </div>
  </div>
</div>

       </div>
</div>
@endsection
