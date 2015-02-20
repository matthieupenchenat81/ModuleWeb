
//Selection d'une recherche d'oeuvre 
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


//Enregistrement d'une liste d'ouevre
$('#enregistrer').click(function() {
    url = "setListOeuvres";
    dataSend = { 
                _token : $('#_token').val(),
                idListeOeuvre : "1",
                oeuvres : "1-2-3-4"};
    $.post(url, 
        dataSend,
        function( data ) {
            ;
    }, "json")
    .done(function() {
        $("#oeuvrePic").append('<div class="alert alert-success">'
        +'<ul>'
        +'<li>Sauvegarde validée</li>'
        +'</ul>'
        +'</div>');
    })
    .fail(function() {
        $("#oeuvrePic").append('<div class="alert alert-danger">'
        +'<strong>Oouups!</strong> Il y a un problème.<br><br>'
        +'<ul>'
        +'<li>Erreur lors de l\'envoie</li>'
        +'</ul>'
        +'</div>');
    });
});

