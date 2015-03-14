@extends('backend/template')
@section('content')
@include('backend/ref_navbar')

<div class="container-fluid">
<div class="row">
    @if (session('message'))
    <div class="col-md-12"><div class="alert alert-success">
      {{ Session::get('message') }}
    </div></div>
  @endif

  @if (session('erreur'))
    <div class="col-md-12"><div class="alert alert-danger">
      {{ Session::get('erreur') }}
    </div></div>
  @endif
<div class="col-md-4">
    <div class="panel panel-primary">
        <div class="panel-heading">Mes listes d'Oeuvres</div>
        <div class="panel-body">
            <form method="post" action="{{ URL::to('referent/changerparamliste') }}">
                <table class="table">
                    <thead class="tablethead">
                        <tr>
                            <th>Liste</th>
                            <th>Mémo</th>
                            <th>Puzzle</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meslistes as $index => $listeoeuvre)
                        <tr>
                            <td>{{$listeoeuvre->nom}}</td>
                            <td><input type="radio" name="memo" value="{{$listeoeuvre->id}}" {{ ($listeoeuvre->actifMemo == 1) ? 'checked' : '' }} type="checkbox"></td>
                            <td><input type="radio" name="puzzle" value="{{$listeoeuvre->id}}" {{ ($listeoeuvre->actifPuzzle == 1) ? 'checked' : '' }} type="checkbox"></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="{{ URL::to('referent/modifierliste', $listeoeuvre->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="{{ URL::to('referent/supprimerliste', $listeoeuvre->id) }}" type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
            </tbody>
            </table>
            <div class="text-center"><button type="submit" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> Enregistrer</button></div>
            <form method="post" action="{{ URL::to('referent/ajouterliste') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="nomListe">Nouvelle liste</label>
                    <div class="input-group">
                        <input type="text" id="nomListe" name="nomListe" class="form-control" placeholder="Nom de la liste">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-plus"></span></button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-8">
@if (isset($mesoeuvres))
<div class="panel panel-primary">
<div class="panel-heading">Liste "{{ $mesoeuvres->nom }}"</div>
<div class="panel-body">
    <ul class="nav nav-tabs" role="tablist" id="myTab">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Oeuvres sélectionnées</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Ajouter une Oeuvre</a></li>
        <li role="presentation"><a href="#tabconfig" aria-controls="profile" role="tab" data-toggle="tab">Configurer la difficulté</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active text-center" id="home">
            <div class="row">
                <div class="col-md-12" style="margin-top:30px;">
                    @if(count($mesoeuvres->oeuvres) == 0)


                        <h3>Aucune oeuvre dans la liste.</h3>
                    @else
                                        <form method="post" action="{{ URL::to('referent/modifierliste/supprimer', $mesoeuvres->id) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <select multiple="multiple" class="multiple" name="todel[]">
                        @foreach($mesoeuvres->oeuvres as $index => $oeuvre)
                        <option data-img-src='http://www.augustins.org/documents/10180/156407/{{ $oeuvre->image }}' value="{{ $oeuvre->id}}"></option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-danger" href="#"><span class="glyphicon glyphicon-trash"></span> Supprimer</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tabconfig">
            <div class="col-md-8 col-md-offset-2" style="margin-top:30px">
                
                <form class="form-horizontal" method="post" action="{{URL::to('referent/changeParamListe', $mesoeuvres->id)}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <legend>Puzzle</legend>
                                <div class="form-group">
                                    <label for="p1" class="col-sm-4 control-label">Dimensions 1 étoile</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="p1" id="p1" placeholder="2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="p2" class="col-sm-4 control-label">Dimensions 2 étoiles</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="p2" id="p2" placeholder="3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="p3" class="col-sm-4 control-label">Dimensions 3 étoiles</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="p3" id="p3" placeholder="4">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pt" class="col-sm-4 control-label">Tableaux par partie</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="pt" id="pt" placeholder="3">
                                    </div>
                                </div>
                                <legend>Mémo</legend>
                                <div class="form-group">
                                    <label for="m1" class="col-sm-4 control-label">Nb. de tableaux 1 étoile</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="m1" id="m1" placeholder="2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="m2" class="col-sm-4 control-label">Nb. de tableaux 2 étoiles</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="m2" id="m2" placeholder="3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="m3" class="col-sm-4 control-label">Nb. de tableaux 3 étoiles</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="m3" id="m3" placeholder="4">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mt" class="col-sm-4 control-label">Tableaux par partie</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="mt" id="mt" placeholder="3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-6">
                                        <button id="search" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">
            <div class="row">
                <div class="col-md-10 col-md-offset-2" style="margin-top:30px">
                    <div class="row">
                        <div class="col-md-10">
                            <form class="form-horizontal" id="recherche">
                                <div class="form-group">
                                    <label for="inputAuteur" class="col-sm-2 control-label">Auteur</label>
                                    <div class="col-sm-10">
                                         <select name="auteur[]" class="form-control" multiple><option>1</option><option>2</option></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDomaine" class="col-sm-2 control-label">Domaine</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="domaine" class="form-control" id="inputDomaine" placeholder="Domaine">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button id="search" class="btn btn-default">Rechercher</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <form method="post" action="{{ URL::to('referent/modifierliste/ajouter', $mesoeuvres->id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="text-center" id="imagesSearched">
                </div>
            </form>
            @else
            <h1>Veuillez selectionner une liste pour la modifier.</h1>
            @endif
        </div>
    </div>
</div>
@endsection
@section('page-css')
<link rel="stylesheet" href="{{ URL::to('css/image-picker.css') }}">
@endsection
@section('page-scripts')
<script src="{{ URL::to('js/image-picker.min.js') }}"></script>
<script>

$("select.multiple").imagepicker(); 
    
    
$('#imagesSearched').load('{{ URL::to('api/searchOeuvres') }}', function(){$("select.multiple").imagepicker();});

$('#imagesSearched').on('click', '.pager a', function (event) {
    event.preventDefault();
    if ( $(this).attr('href') != '#' ) {
        $("#imagesSearched").animate({ scrollTop: 0 }, "fast");
        $.get($(this).attr('href'), $('#recherche').serialize(),
        function(data){
            $('#imagesSearched').empty();
            $('#imagesSearched').append(data);
            $("select.multiple").imagepicker();
        });
    }

});

$("#recherche").on('submit', function(event){
    event.preventDefault();
    $('#imagesSearched').empty();
    $('#imagesSearched').append("Recherche en cours...");
    $.get("{{ URL::to('api/searchOeuvres') }}", $('#recherche').serialize(),
    function(data){
        $('#imagesSearched').empty();
        $('#imagesSearched').append(data);
        $("select.multiple").imagepicker();
    });
    
});
/*
    
    
        
    $("#search").click(function(){
            event.preventDefault();
            $('#imagesSearched').empty();
            $('#imagesSearched').append("Recherche en cours");
    
        $.get(" {{ URL::to('api/searchOeuvres') }}", { domaine : $('#domaine').val() },
        function(data){
            $('#imagesSearched').empty();
            $('#imagesSearched').append('<select multiple="multiple" id="toadd" name="toadd[]">');                 
            $(data.data).each(function(id, elt){
                $('#toadd').append("<option data-img-src='http://www.augustins.org/documents/10180/156407/" + elt.image +"' value=\""+ elt.id+"\"></option>");
            });
            $('#imagesSearched').append('<button type="submit" id="search" class="btn btn-default">Ajouter</button>');
    
            $("#toadd").imagepicker();
        }, "json");
    });*/
                        
</script>
@endsection