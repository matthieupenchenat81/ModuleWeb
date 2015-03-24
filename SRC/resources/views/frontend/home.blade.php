@extends('frontend/template')

@section('content')
@if ($referents != [])
<div id="infoHome" style="@if($cookie == 'open')display: none @endif;text-align:center;background-color: #fcfc6b; padding:10px; margin:auto;font-size:18px;">
		<a href="#" onClick="cache();" style="float:right; text-decoration:none; color:red;"><span class="icon-cross"></span></a>
    	<h1 class="homeTitle">Les jeux du Musée des Augustins</h1>

    L'objectif de ce site est de permettre aux enfants de jouer à des jeux tout en leur apportant de l'intérêt pour les différentes oeuvres d'art exposées dans le fameux musée toulousain.<br>
    <span style="color:red;">Lorsque vous aurez choisit un référent, il faudra appuyer pendant 3 secondes sur l'icone de votre référent afin de revenir sur cette page.</span><br>
    Si vous n'avez pas de référent, vous pouvez toujours <span style="color:#37378e;"><a href="/">cliquer ici pour jouer aux jeux</a></span>, sinon cliquez sur leur image.   
</div>

<div id="txt_show" style="@if($cookie == 'close')display: none; @endif text-align:center;background-color: #fcfc6b; padding:10px; margin:auto;font-size:18px;">
  <a href="#" style="text-align:center;background-color: #fcfc6b; padding:10px; margin:auto;font-size:18px;" onClick="cache();">À Propos</a>
    Si vous n'avez pas de référent, vous pouvez toujours <span style="color:#37378e;"><a href="/changerref/1">cliquer ici pour jouer aux jeux</a></span>, sinon cliquez sur leur image.
</div>
    <nav>
            <input name="searchterm" class="icon-search" id="searchterm" placeholder="&#xe986; Rechercher un référent" type="text"> 
    </nav>
        <div id="referents" class="referents">

    @foreach ($referents as $referent)
            <div class="referent" 
                 onclick='location.href = "{{ URL::to('changerref', $referent->id) }}";'
                 style="background-image:url('{{ URL::to('/') }}/{{ $referent -> image }}')">
                <div class="infos">{{ $referent -> prenom }} {{ $referent -> nom }}</div>
            </div>
    @endforeach
        </div>   
@else
    <h1>Aucun référent trouvé</h1>
@endif
@endsection

@section('page-css')
	<link href="{{URL::to('css/fonts/style.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('page-scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script type="text/javascript">

     
     
          $("#searchterm").on('input', function(e){
            var q = $("#searchterm").val();
            var url = (q == "") ? '{{URL::to('api/searchRef')}}' : '{{URL::to('api/searchRef')}}/' + q;
            $.getJSON(url, function(data) {
              $("#referents").empty();
              $.each(data, function(i,item){
                $("#referents").append('<div class="referent" onclick=\'location.href = "{{ URL::to('changerref') }}/'+ item.id + '"\' style="background-image:url(\'{{ URL::to('/') }}/'+item.image+'\')"><div class="infos">'+ item.prenom + " " + item.nom + '</div></div>');
              });
            });
          });

</script>

<script>

	function cache() {
		
    $.get("toogleInfoBar", function() {});

    // Toogle
    $('#infoHome').toggle('display');
    $('#txt_show').toggle('display');
	}
</script>
@endsection