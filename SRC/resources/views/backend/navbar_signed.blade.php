<link href="css/navbar.css" rel="stylesheet" type="text/css"/>
<nav class="navbar navbar-default">
  <div class="container-fluid">
  	<a class="navbar-brand" href="#">Espace {{ $nameRoute }}</a>
 	<p class="navbar-text"><img height="25" width="25" src="{{$me->image}}"></img> </p>
  	<p class="navbar-text">{{$me->firstname}} {{$me->lastname}}</p>
  	<p class="navbar-text">{{$me->email}}</p>
  	<ul class="nav navbar-nav navbar-right">
        <li>
        	@if (!Session::has('admin'))
        	<a href="logout">Se déconnecter</a>
        	@else
        	<a href="admin">Retour Admin</a>
        	@endif
        </li>
     </ul>
  	<ul class="nav navbar-nav navbar-right">
        <li>
     		<a data-toggle="modal" data-target="#myModal1">Mes paramètres</a>
        </li>
    </ul>
  </div>
</nav>


<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Informations personnelles</h4>
      </div>
      <form class="form-horizontal" role="form" @if ($me->droits == 0) action="update" @else action="updateUser" @endif method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="idUser" value="{{ $me->id }}" />
      <div class="modal-body">
            <div class="form-group">
              <label for="firstname" class="col-sm-2 control-label">Prénom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" name="firstname" required placeholder="Prénom" value="{{$me->firstname}}">
              </div>
            </div>
            <div class="form-group">
              <label for="lastname" class="col-sm-2 control-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="lastname" name="lastname" required placeholder="Nom" value="{{$me->lastname}}">
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required placeholder="Email" value="{{$me->email}}">
              </div>
            </div>
            <div class="form-group">
              <label for="city" class="col-sm-2 control-label">Ecole</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="city" name="school" required placeholder="Ecole" value="{{$me->school}}">
              </div>
            </div>
            <div class="form-group">
    			    <label class="col-sm-2 control-label" for="exampleInputFile">Image</label>
    			    <div class="col-sm-10">
                <input type="file" name="file" id="file">
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