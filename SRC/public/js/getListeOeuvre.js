$(document).ready( function() {
 
    $( '.listeoeuvre' ).click(function(this) {
        id = $(this).$('.idListeOeuvre').val();
        $.get("showListOeuvres/"+id, function( data ) {
            data.forEach( function(el) {
                $("#oeuvrePic").append('<div class="col-xs-4 col-md-3">')
                .append('<div class="col-xs-4 col-md-3">')
                .append('<a href="#" class="thumbnail">')
                .append('<img src="http://www.augustins.org/documents/10180/156407/').append(el.urlPhoto).append('">')
                .append('</a></div>');
            })   
        });
 
        //prevent the form from actually submitting in browser
        return false;
    } );
 
} );
