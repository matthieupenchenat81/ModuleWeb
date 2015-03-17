@extends('frontend/template')

@section('content')
@if ($referents != [])
	<h1 class="homeTitle"> Jeux Educatifs du musée Augustin  </h1>
    <nav>
            <input name="searchterm" class="icon-search" id="searchterm" placeholder="&#xe986; Rechercher un référent" type="text"> 
    </nav>
        <div id="referents" class="referents">

    @foreach ($referents as $referent)
            <div class="referent" 
                 onclick='location.href = "{{ URL::to('changerref', $referent->id) }}";'
                 style="background-image:url('{{ $referent -> image }}')"> 
                <div class="infos">{{ $referent -> prenom }} {{ $referent -> nom }}</div>
            </div>
    @endforeach
        </div>   
@else
    <h1>Aucun référent trouvé</h1>
@endif
@endsection

@section('page-css')
	<link href="css/fonts/style.css" rel="stylesheet" type="text/css">
@endsection

@section('page-scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script type="text/javascript">

     
     
          $("#searchterm").on('input', function(e){
            var q = $("#searchterm").val();
            var url = (q == "") ? 'api/searchRef' : 'api/searchRef/' + q;
            $.getJSON(url, function(data) {
              $("#referents").empty();
              $.each(data, function(i,item){
                $("#referents").append('<div class="referent" onclick=\'location.href = "{{ URL::to('changerref') }}/'+ item.id + '"\' style="background-image:url(\''+item.image+'\')"><div class="infos">'+ item.prenom + " " + item.nom + '</div></div>');
              });
            });
          });

</script>
@endsection