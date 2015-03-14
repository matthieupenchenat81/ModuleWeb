@extends('frontend/template')

@section('content')
@if ($referents != [])

    <nav>
            <input name="searchterm" id="searchterm" placeholder="Rechercher un référent" type="text"> 
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