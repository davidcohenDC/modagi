<link rel="stylesheet" href="./css/notification/notification.css" />


<div class="icon" id="bell">
    <span id="outCounter" class="badge badge-pill red">
        <?php echo $notificationCount; ?>
    </span>
    <img src="https://i.imgur.com/AC7dgLA.png" alt="">
</div>
<div class="notifications" id="box">
    <span class="h2">Notifiche - <span id="inCounter"><?php echo $notificationCount ?></span></span>
    <?php foreach ($allNotification as $notify): ?>
    <div class="notifications-item">
        <div class="text">
            <h4><?php echo $notify["nome"] ?></h4>
            <p><?php echo $notify["contenuto"] ?></p>
        </div>
    </div>
    <?php endforeach ?>
</div>

<script>
    $(document).ready(function(){
        var down = false;
        var clear = false;

        if(parseInt($('#outCounter').text()) > 0) {
            $('#outCounter').css("background", "#f00");
        }

        $('#bell').click(function(e){
            var color = $(this).text();
            if(down){
                $('#box').css('height','0px');
                $('#box').css('opacity','0');
                $('#inCounter').text("0");
                $('#outCounter').text("0");
                down = false;
            }else{
                if(clear) {
                    $('.notifications-item').html("");
                }
                $('#box').css('height','auto');
                $('#box').css('opacity','1');
                $('#outCounter').css("background", "#343a40");
                $.ajax({
                    type: "POST",
                    url: "./ajaxFunction/clearNotification.php"
                }).done(function( msg ) {
                    //alert(msg);
                    clear = true;
                });
                down = true;
            }
        });
    });
</script>