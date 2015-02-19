$(document).ready( function() {
    $('#enregistrer').click(function() {
        event.preventDefault();
        send = {idListeOeuvre : " " , 
                idOeuvres : [1,2,3,4,4] }
        url = "/setListOeuvres";
        $.post(url, 
            send,
            function( data ) {
        })
        .done(function() {
            console.log( "success" );
          })
        .fail(function() {
            console.log( "error" );
        });
    });

});

