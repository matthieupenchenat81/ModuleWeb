<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".nav-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Espace Référent</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Mes Listes</a></li>
        <li><a data-toggle="modal" data-target="#myModal1" href="#">Mon Compte</a></li>
        <li><a href="{{ URL::to('logout') }}">Se Déconnecter</a></li>
      </ul>
      <p class="navbar-text navbar-right">Connecté en tant que {{ $me->prenom }} {{ $me->nom }}</p>
    <!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Informations personnelles</h4>
      </div>
      <form class="form-horizontal" role="form" action="{{ URL::to('referent/update') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="idUser" value="{{ $me->id }}" />
      <div class="modal-body">
            <div class="form-group">
              <label for="firstname" class="col-sm-2 control-label">Prénom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" name="prenom" required placeholder="Prénom" value="{{$me->prenom}}">
              </div>
            </div>
            <div class="form-group">
              <label for="lastname" class="col-sm-2 control-label">Nom</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="lastname" name="nom" required placeholder="Nom" value="{{$me->nom}}">
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" required placeholder="Email" value="{{$me->email}}">
              </div>
            </div>
            <div class="form-group">
              <label for="city" class="col-sm-2 control-label">Etablissement</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="city" name="etablissement" required placeholder="Ecole" value="{{$me->etablissement}}">
              </div>
            </div>
            <div class="form-group">
    			    <label class="col-sm-2 control-label" for="exampleInputFile">Image</label>
    			    <div class="col-sm-10">
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