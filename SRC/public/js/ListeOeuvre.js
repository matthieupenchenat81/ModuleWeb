$(document).ready( function() {
    console.log( "document loaded" );
    $('.listeoeuvre').click(function() {
        $('#oeuvrePic').empty();
        url = "/showListOeuvres/" + $(this).children('.idListeOeuvre').val();
        $.get(url, function( data ) {
            if (data.length == 0 )
                $("#oeuvrePic").append("Aucune Oeuvre");
            data.forEach( function(el) {
                $("#oeuvrePic").append('<div class="col-xs-4 col-md-3">'
                +'<a href="#" class="thumbnail">'
                +'<img src="http://www.augustins.org/documents/10180/156407/' + el.urlPhoto + '"/>'
                +'</a></div>');
            })
        }, "json" )
        
        .fail(function() {
            $("#oeuvrePic").append('<div class="alert alert-danger">'
            +'<strong>Oouups!</strong> Il y a un problème.<br><br>'
            +'<ul>'
            +'<li>Erreur lors de la récupération</li>'
            +'</ul>'
            +'</div>'
            );
        });
    });
});

