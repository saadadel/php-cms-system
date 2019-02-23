
$(document).ready(function(){

    //CK Editor
    ClassicEditor
    .create( document.querySelector( '#textarea_ck' ) )
    .catch( error => {
        console.error( error );
    } );

    // Clickable row in table
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });

    
});
