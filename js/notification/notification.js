$(document).ready(function(){
    let down = false;
    let clear = false;

    if(parseInt($('#outCounter').text()) > 0) {
        $('#outCounter').css("background", "#f00");
    }

    $('#bell').click(function(e){
        if(down){
            $('#box').css('height','0px');
            $('#box').css('opacity','0');
            down = false;
        }else{
            if(clear) {
                $('.notifications-item').remove();
            }
            $('#box').css('height','auto');
            $('#box').css('opacity','1');
            $.ajax({
                type: "POST",
                url: "./ajaxFunction/clearNotification.php"
            }).done(function( msg ) {
                clear = true;
                $('#inCounter').text("0");
                $('#outCounter').text("0");
                $('#outCounter').css("background", "");
            });
            down = true;
        }
    });
});