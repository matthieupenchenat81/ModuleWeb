<nav class="navbar navbar-default">
  <div class="container-fluid">
  	<a class="navbar-brand" href="#">Espace {{ $nameRoute }}</a>
 	<p class="navbar-text"><img height="25" weight="25" src="{{$me->image}}"></img> </p>
  	<p class="navbar-text">{{$me->firstname}}</p>
  	<p class="navbar-text">{{$me->lastname}}</p>
  	<p class="navbar-text">{{$me->email}}</p>
  	<ul class="nav navbar-nav navbar-right">
        <li>
        	<a href="logout">Se déconnecter</a>
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
      <form class="form-horizontal" method="POST" role="form" action="updateUser">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
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
              <label for="city" class="col-sm-2 control-label">Ville</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="city" name="city" required placeholder="Ville" value="{{$me->city}}">
              </div>
            </div>
            @if ($me->droits != 0)
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input name="isadmin" checked="checked" type="checkbox"> Est administrateur
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