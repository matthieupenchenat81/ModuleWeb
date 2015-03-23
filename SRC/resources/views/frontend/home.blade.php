@extends('frontend/template')

@section('content')
@if ($referents != [])
<div id="infoHome" style="text-align:center;background-color: #fcfc6b; padding:10px; margin:auto;font-size:18px; display:block;">
		<a href="#" onClick="cache();"><span class="icon-cross"></span></a>
    	<h1 class="homeTitle">Les jeux du Musée des Augustins</h1>

    L'objectif de ce site est de permettre aux enfants de jouer à des jeux tout en leur apportant de l'intérêt pour les différentes oeuvres d'art exposées dans le fameux musée toulousain.<br>
    <span style="color:red;">Lorsque vous aurez choisit un référent, il faudra appuyer pendant 3 secondes sur l'icone de votre référent afin de revenir sur cette page.</span><br>
    Si vous n'avez pas de référent, vous pouvez toujours <span style="color:#37378e;"><a href="/">cliquer ici pour jouer aux jeux</a></span>, sinon cliquez sur leur image.
    
</div>
<a href="#" onClick="cache();"><span id="txt_show" style="display:none;">Afficher</span></a>
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

<script>
	function cache() {
		var txt = document.getElementById('infoHome');
		var span = document.getElementById('txt_show');
		
		if (txt.style.display  ==  "block")
		{
			//si le texte est afficher on cache le txt et on affiche le span cache
			span.style.display = "block";
			txt.style.display = "none";
		}	
		else 
		{
			//sinon on affiche le texte et on cache le span
			span.style.display = "none";
			txt.style.display = "block";
		}
	}
</script>
@endsection