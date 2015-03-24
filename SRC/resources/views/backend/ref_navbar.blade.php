<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Espace Référent</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Mes Listes</a></li>
        <li><a data-toggle="modal" data-target="#myModal1" href="#">Mon Compte</a></li>
        <li><a href="{{ URL::to('changerref', $me->id) }}" >Essayer mes jeux</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="{{ URL::to('logout') }}">Déconnexion</a></li>
            </ul>
                          <p class="navbar-text navbar-right">Connecté en tant que {{ $me->prenom }} {{ $me->nom }}</p>

          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mon Compte</h4>
      </div>
      <div style="margin:auto;width:120px; height: 120px; border-radius:50%;background-size:cover;background-position: center center;
      background-image:url('{{ URL::to('/')}}/{{ $me->image }}')"></div>
      <form class="form-horizontal" role="form" action="{{ URL::to('referent/update') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="idUser" value="{{ $me->id }}" />
      <div class="modal-body">
            <div class="form-group">
              <label for="firstname" class="col-sm-4 control-label">Prénom :</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="firstname" name="prenom" required placeholder="Prénom" value="{{$me->prenom}}">
              </div>
            </div>
            <div class="form-group">
              <label for="lastname" class="col-sm-4 control-label">Nom :</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="lastname" name="nom" required placeholder="Nom" value="{{$me->nom}}">
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-4 control-label">Email :</label>
              <div class="col-sm-8">
                <input type="email" class="form-control" id="email" name="email" required placeholder="Email" value="{{$me->email}}">
              </div>
            </div>
            <div class="form-group">
              <label for="password_confirm" class="col-sm-4 control-label">Nouveau mot de passe :</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
              </div>
            </div>
            <div class="form-group">
              <label for="password_confirm" class="col-sm-4 control-label">Confirmer le mot de passe :</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Mot de passe">
              </div>
            </div>
            <div class="form-group">
    			    <label class="col-sm-4 control-label" for="exampleInputFile">Image :</label>
    			    <div class="col-sm-8">
                        <input type="file" class="form-control" name="file" id="file">
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