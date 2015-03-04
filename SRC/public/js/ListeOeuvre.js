function showSelection() {
    $('#addpicture').hide();
    $('#selection').show("slow");
    $('#liAddImages').removeClass("active");
    $('#liSelection').addClass("active");
}

function showAddPicture() {
    $('#selection').hide();
    $('#addpicture').show("slow");
    $('#liSelection').removeClass("active");
    $('#liAddImages').addClass("active");
}



//Selection d'une recherche d'oeuvre 
$('.listeoeuvre').click(function(event) {
	showSelection();
	$("#sessionName").empty();
	$("#sessionName").text($(this).children(".sessionName").text());
    $('.listeoeuvre').removeClass("active");
    $(this).addClass("active");
    $('#oeuvrePic').empty();
    
    // asso games
    url = "/getAssoGames/" + $(this).children('.idListeOeuvre').val();
    var p = new XMLHttpRequest(); 
    p.open("GET", url, true); 
    p.onreadystatechange = function () { 
        if (p.readyState != 4 || p.status != 200) 
            return; 
        var data2  = JSON.parse(p.response);
        $( ".checkboxGame" ).prop( "checked", false);

        for (el in data2) {
            id = data2[el].id;
            $('#checkbox' + id).prop( "checked", true );
        }
    };
    p.send();

    url = "/showListOeuvres/" + $(this).children('.idListeOeuvre').val();
    var r = new XMLHttpRequest(); 
    r.open("GET", url, true); 
    r.onreadystatechange = function () { 
        if (r.readyState != 4 || r.status != 200) 
            return; 
        var data  = JSON.parse(r.response);
        if (data.length == 0 )
            $("#oeuvrePic").append("Aucune Oeuvre");
        else {
            $("#oeuvrePic").append('<select multiple="multiple" id="my_selection" name="my_selection" class="image-picker show-html">');
            for (el in data)
            {   
                $('#my_selection').append('<option data-img-src="http://www.augustins.org/documents/10180/156407/' + data[el].urlPhoto + '" id="selection'+ data[el].id +'" value="'+ data[el].id + '"></option>');
                $("select").imagepicker();
            }   
        }
    };
    r.send();
});



//Enregistrement d'une liste d'ouevre
$('#enregistrer').click(function() {
    url = "setListOeuvres";
    dataSend = { 
                _token : $('#_tokenRes').val(),
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


// Suppression des n oeuvres selectionnés
$('#removeFromSelection').click(function() {

    url = "removeFromSelection";
    dataSend = { 
        _token : $('#_tokenRemoveFromSelection').val(),
        oeuvres : $('#my_selection').val()};
    $.post(url, 
        dataSend,
        function( data ) {
            ;
        }, "json")
    .done(function() {
        $('#my_selection').val().forEach( function(el) {
            $('#selection'+ el).remove();
        });
        $("select").imagepicker();
    })
    .fail(function() {
        $("#oeuvrePic").append('<div class="alert alert-danger">'
        +'<strong>Oouups!</strong> Il y a un problème.<br><br>'
        +'<ul>'
        +'<li>Erreur lors de la Suppression</li>'
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
    }else if (this.id == $('#previous').attr('id')) {
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
    if (data.data.length == 0 )
        $("#oeuvreRes").append("Aucune Oeuvre Trouvé..");
    else {
        $("#oeuvreRes").append('<select multiple="multiple" id="my_researches" class="image-picker show-html">');
        data.data.forEach( function(el) {
            $('#my_researches').append('<option data-img-src="http://www.augustins.org/documents/10180/156407/' + el.urlPhoto + '" value="'+ el.id + '"></option>');
            $("select").imagepicker();
        });
    } 
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

    var searchValues = $(".checkboxGame").map(function(){
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
	showSelection();
});

$('#liAddImages').click(function() {
	showAddPicture();
});



