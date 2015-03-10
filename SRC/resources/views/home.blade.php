@extends('app')
@section('content')

@if ($referents != [])

 <nav>
            <form>
                <input name="searchterm" id="searchterm" placeholder="Rechercher un référent" type="text"> 
            </form>
        </nav>
        <div id="referents" class="referents">

    @foreach ($referents as $referent)
       

            <a href="/referents/{{$referent->id}}/games">
                <div class="referent" style="background-image:url('{{ $referent -> image }}')"> 
                    <div class="infos">{{ $referent -> firstname }} {{ $referent -> lastname }}</div>
                </div>
            </a>

   
    @endforeach
        </div>   

 <script type="text/javascript">
          $("#searchterm").keyup(function(e){
            var q = $("#searchterm").val();
            $.getJSON("searchRef/" + q, function(data) {
              $("#referents").empty();
              $.each(data.query.search, function(i,item){
                $("#referents").append('<div class="referent" style="background-image:url(\'4.jpg\')"><div class="infos">'+ item.firstname +'</div></div>');
              });
            });
          });

    </script>
@else
    <h1>Aucun référent trouvé</h1>
@endif
@endsection
