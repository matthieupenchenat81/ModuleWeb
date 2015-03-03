
//Selection d'une recherche d'oeuvre 
$('.listeoeuvre').click(function(event) {
    $('.listeoeuvre').removeClass("active");
    $(this).addClass("active");
    $('#oeuvrePic').empty();
    url = "/showListOeuvres/" + $(this).children('.idListeOeuvre').val();


    var req = new XMLHttpRequest();
    req.onload = function(e) {
              var data  = req.reponse;
        if (data.length == 0 )

            $("#oeuvrePic").append("Aucune Oeuvre");
        data.forEach( function(el) {
            $("#oeuvrePic").append('<div class="col-xs-4 col-md-3">'
            +'<a href="#" class="thumbnail">'
            +'<img src="http://www.augustins.org/documents/10180/156407/' + el.urlPhoto + '"/>'
            +'</a></div>');
    });
    req.open('GET', url, true);
    req.send();


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
if(this.id == $('#next').attr('id') && $("#next").parent().hasClass('disabled') || this.id == $('#previous').attr('id') && $("#previous").parent().hasClass('disabled'))
    return 0;
if (this.id == $('#next').attr('id')) {
    str = $("#next").attr('href');
    url = "/search?page="+/([0-9]+)/.exec(/page=([0-9]+)/.exec(str)[0])[0];
}else 
    if (this.id == $('#previous').attr('id')) {
        str = $("#previous").attr('href');
        url = "/search?page="+/([0-9]+)/.exec(/page=([0-9]+)/.exec(str)[0])[0];
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




// Mettre à jour les jeux associés à la liste d'oeuvre
$('.checkbox').click(function(event) {

    // Recuperation des données necessaire au traitement
    var searchIDs = $("input#idGame").map(function(){
      return $(this).val();
    }).get();

    var searchValues = $("input#checkbox").map(function(){
      return $(this).is(":checked");
    }).get();

    r = [];
    for (i = 0; i < searchIDs.length; i++) {
        r[searchIDs[i]] = searchValues[i];
    }

    dataSend = { _token : $('#_tokenRes').val(), data: r };
    $.post('updateAssoGames', dataSend, function() {
            // Nada
    }, "json" )
    
    .fail(function() {
        // Nada
    });

});


//swicth onglets de bg  ma selection /ajouter 
$('#liSelection').click(function() {
    $('#addpicture').hide();
    $('#selection').show("slow");
    $('#liAddImages').removeClass("active");
    $('#liSelection').addClass("active");
});

$('#liAddImages').click(function() {
    $('#selection').hide();
    $('#addpicture').show("slow");
    $('#liSelection').removeClass("active");
    $('#liAddImages').addClass("active");
});



