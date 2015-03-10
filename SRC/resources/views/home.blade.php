@extends('app')
@section('content')
{{ HTML::style('css/frontend.css'); }}

<nav>
    <form onsubmit="rechercherReferent()">
        <div class="row divRecherche">
            <input name="ref" id="ref" placeholder="Rechercher un référent" type="text"> 
        </div>
    </form>
</nav>

@if ($referents != [])

 <nav>
            <form>
                <input name="searchterm" id="searchterm" placeholder="Rechercher un référent" type="text"> 
            </form>
        </nav>
        <div id="referents" class="referents">

    @foreach ($referents as $referent)
       

            <div class="referent" style="background-image:url('{{ $ref -> image }}')"> 
                <div class="infos">{{ $referent -> firstname }} {{ $referent -> lastname }}</div>
            </div>

   
    @endforeach
        </div>   

 <script type="text/javascript">
          $("#searchterm").keyup(function(e){
            var q = $("#searchterm").val();
            $.getJSON("searchRef/" + q, function(data) {
              $("#referents").empty();
              $.each(data.query.search, function(i,item){
                $("#referents").append('<div class="referent" style="background-image:url('4.jpg')"><div class="infos">'+ item.firstname +'</div></div>');
              });
            });
          });

    </script>
@else
    <h1>Aucun référent trouvé</h1>
@endif
@endsection
