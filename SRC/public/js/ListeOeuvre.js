
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


// Afficher résultat de recherche d'oeuvre
$('#search_button, #previous, #next').click(function(event) {

    event.preventDefault();

    if (this.id == $('#next').attr('id')) {
        str = $("#next").attr('href');
        console.log(/([0-9]+)/.exec(str));
        url = "/search?page="+/([0-9]+)/.exec(str)[0];
    }else if (this.id == $('#previous').attr('id')) {
        str = $("#previous").attr('href');
        url = "/search?page="+/([0-9]+)/.exec(str)[0];
    }else {
        url = "/search";
    }

    $('#oeuvreRes').empty();
    dataSend = { 
                _token : $('#_tokenRes').val(),
                auteur: $('#auteur').val(),
                designation: $('#designation').val(),
                matiere: $('#matiere').val(),
                domaine: $('#domaine').val(),
                technique: $('#technique').val(),
                debut: $('#debut').val(),
                fin: $('#fin').val()
            };
    $.post(url,
        dataSend,
        function( data ) {
            console.log(data);
            if (data.length == 0 )
                $("#oeuvreRes").append("Aucune Oeuvre Trouvé..");
            data.data.forEach( function(el) {
                $("#oeuvreRes").append('<div class="col-xs-4 col-md-3">'
                +'<a href="#" class="thumbnail">'
                +'<img src="http://www.augustins.org/documents/10180/156407/' + el.urlPhoto + '"/>'
                +'</a></div>');
            });

            if(data.prev_page_url == null) {
                $("#previous").parent().addClass('disabled');
            }else {
                $("#previous").attr('href', data.prev_page_url);
                $("#previous").parent().removeClass('disabled');
            }

            if(data.next_page_url == null) {
                $("#next").parent().addClass('disabled');                     
            }else {
                $("#next").attr('href', data.next_page_url);    
                $("#next").parent().removeClass('disabled');
            }
            
    }, "json" )
    
    .fail(function() {
        $("#oeuvreRes").append('<div class="alert alert-danger">'
        +'<strong>Oouups!</strong> Il y a un problème.<br><br>'
        +'<ul>'
        +'<li>Erreur lors de la récupération</li>'
        +'</ul>'
        +'</div>'
        );
    });
});


