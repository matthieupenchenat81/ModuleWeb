$(document).ready( function() {
    console.log( "document loaded" );
    $('.listeoeuvre').click(function() {
        url = "/showListOeuvres/" + $(this).children('.idListeOeuvre').val();
        $.get(url, function( data ) {
            data.forEach( function(el) {
                $("#oeuvrePic").append('<div class="col-xs-4 col-md-3">')
                .append('<a href="#" class="thumbnail">')
                .append('<img width="50px" src="http://www.augustins.org/documents/10180/156407/' + el.urlPhoto + '"/>')
                .append('</a></div>');
            })
        }, "json" )
        
        .fail(function() {
            console.log( "error" );
        });
    });
});

