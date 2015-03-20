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
            <form method="post" action="{{ URL::to('referent/ajouterliste') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="nomListe">Nouvelle liste :</label>
                    <div class="input-group">
                        <input type="text" id="nomListe" name="nomListe" class="form-control" placeholder="Nom de la liste">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-plus"></span></button>
                        </span>
                    </div>
                </div>
            </form>
            <div class="alert alert-grey">Ci-dessous, vous pouvez associer les listes d'oeuvres à un jeu. Cliquez sur le bouton "<span class="glyphicon glyphicon-ok"> </span> Associer" quand c'est terminé.</div>
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
                        <tr>
                            <td>Liste aléatoire</td>
                            <td><input type="radio" name="memo" value="0" checked type="checkbox"></td>
                            <td><input type="radio" name="puzzle" value="0" checked type="checkbox"></td>
                            <td></td>
                        </tr>
                        @foreach ($meslistes as $index => $listeoeuvre)
                        <tr>
                            <td>{{$listeoeuvre->nom}}</td>
                            <td><input type="radio" name="memo" value="{{$listeoeuvre->id}}" {{ ($listeoeuvre->actifMemo == 1) ? 'checked' : '' }} type="checkbox"></td>
                            <td><input type="radio" name="puzzle" value="{{$listeoeuvre->id}}" {{ ($listeoeuvre->actifPuzzle == 1) ? 'checked' : '' }} type="checkbox"></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="{{ URL::to('referent/modifierliste', $listeoeuvre->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="{{ URL::to('referent/supprimerliste', $listeoeuvre->id) }}" type="button" class="confirm btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
            </tbody>
            </table>
            <div class="text-center"><button type="submit" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-ok-circle"> </span> Associer</button></div>
            
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


                        <h5>Aucune oeuvre dans la liste.</h5>
                    @else
                                        <form method="post" action="{{ URL::to('referent/modifierliste/supprimer', $mesoeuvres->id) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <select multiple="multiple" class="multiple" name="todel[]">
                        @foreach($mesoeuvres->oeuvres as $index => $oeuvre)
                        <option data-img-src='/image/200/{{ $oeuvre->image }}' value="{{ $oeuvre->id}}"></option>
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

                    <legend>Puzzle</legend><p>2 images = 2 lignes / 2 colones</p>
                                <div class="form-group">
                                    <label for="p1" class="col-sm-4 control-label">Images pour 1 étoile </label>
                                    <div class="col-sm-6">
                                        <input type="number" min="1" max="10" class="form-control" value="{{$paramjeu->p1}}" name="p1" id="p1" placeholder="2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="p2" class="col-sm-4 control-label">Images pour 2 étoiles</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="1" max="10" class="form-control" value="{{$paramjeu->p2}}" name="p2" id="p2" placeholder="3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="p3" class="col-sm-4 control-label">Images pour 3 étoiles</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="1" max="10" class="form-control" value="{{$paramjeu->p3}}" name="p3" id="p3" placeholder="4">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pt" class="col-sm-4 control-label">Tableaux par partie</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="1" max="10" class="form-control" value="{{$paramjeu->pt}}" name="pt" id="pt" placeholder="3">
                                    </div>
                                </div>
                                <legend>Mémo</legend>
                                <div class="form-group">
                                    <label for="m1" class="col-sm-4 control-label">Nb. de tableaux 1 étoile</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="1" max="2" class="form-control" value="{{$paramjeu->m1}}" name="m1" id="m1" placeholder="2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="m2" class="col-sm-4 control-label">Nb. de tableaux 2 étoiles</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="1" max="4" class="form-control" value="{{$paramjeu->m2}}" name="m2" id="m2" placeholder="3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="m3" class="col-sm-4 control-label">Nb. de tableaux 3 étoiles</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="1" max="8" class="form-control" value="{{$paramjeu->m3}}" name="m3" id="m3" placeholder="4">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mt" class="col-sm-4 control-label">Tableaux par partie</label>
                                    <div class="col-sm-6">
                                        <input type="number" min="1" max="10" class="form-control" value="{{$paramjeu->mt}}" name="mt" id="mt" placeholder="3">
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
                                    <label for="designation" class="col-sm-2 control-label">Désignation</label>
                                    <div class="col-sm-10">
                                         <input id="designation" name="designation" class="form-control" placeholder="Désignation">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="auteur" class="col-sm-2 control-label">Auteur</label>
                                    <div class="col-sm-10">
                                         <select id="auteur" name="auteur[]" class="form-control" multiple>
                                            @foreach($auteurs as $e)
                                             <option value="{{ $e->id }}">{{ $e->nom }}</option>
                                             @endforeach
                                         </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="domaine" class="col-sm-2 control-label">Domaine</label>
                                    <div class="col-sm-10">
                                        <select id="domaine" name="domaine[]" class="form-control" multiple>
                                            @foreach($domaines as $e)
                                             <option value="{{ $e->id }}">{{ $e->nom }}</option>
                                             @endforeach
                                         </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="matiere" class="col-sm-2 control-label">Matière</label>
                                    <div class="col-sm-10">
                                        <select id="matiere" name="matiere[]" class="form-control" multiple>
                                            @foreach($matieres as $e)
                                             <option value="{{ $e->id }}">{{ $e->nom }}</option>
                                             @endforeach
                                         </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="domaine" class="col-sm-2 control-label">Technique</label>
                                    <div class="col-sm-10">
                                        <select id="technique" name="technique[]" class="form-control" multiple>
                                            @foreach($techniques as $e)
                                             <option value="{{ $e->id }}">{{ $e->nom }}</option>
                                             @endforeach
                                         </select>
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
            <div class="alert alert-grey">Cliquez sur le bouton <span class="glyphicon glyphicon-pencil"></span> pour modifier une liste.</div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('page-css')
<link rel="stylesheet" href="{{ URL::to('css/image-picker.css') }}">
<link rel="stylesheet" href="{{ URL::to('css/bootstrap-multiselect.css') }}">
<style>
    .thumbnails .thumbnail {
        margin-bottom: 0;
    }
    .thumbnail img {
        width:100%;
        height: 100px;
    }

</style>
@endsection
@section('page-scripts')
<script src="{{ URL::to('js/image-picker.min.js') }}"></script>
<script src="{{ URL::to('js/bootstrap-multiselect.js') }}"></script>
<script>
$("select.multiple").imagepicker();
$('.confirm').click(function(e) {
    if (!confirm('Voulez-vous vraiment confirmer la supression ?')) e.preventDefault();
});

$('#imagesSearched').load('{{ URL::to('api/searchOeuvres') }}', function(){$("select.multiple").imagepicker();});


 /*function fitGrid(){
   $('.thumbnails').masonry({
            itemSelector: 'li',
            gutterWidth: 10
    }).masonry('reload');
};*/

$('#imagesSearched').on('click', '.pagination a', function (event) {
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


$('#recherche select').multiselect({
    enableFiltering: true,
    buttonWidth: '100%',
    maxHeight: 200,
    enableCaseInsensitiveFiltering: true
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
