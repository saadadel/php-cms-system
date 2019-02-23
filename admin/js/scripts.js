
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

function loadUsersOnline(){
    $.get("functions.php?users_online=result", function (data) {
            $(".users_online").text(data);
        }
    );
}
setInterval(function(){

    loadUsersOnline();


},500);

