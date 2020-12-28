<link rel="stylesheet" href="./css/notification/notification.css" />


<div class="icon" id="bell">
    <span id="notificationCounter" class="badge badge-pill red">
        <?php echo $notificationCount; ?>
    </span>
    <img src="https://i.imgur.com/AC7dgLA.png" alt="">
</div>
<div class="notifications" id="box">
    <h2>Notifiche - <span><?php echo $notificationCount ?></span></h2>
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

        $('#bell').click(function(e){
            var color = $(this).text();
            if(down){
                $('#box').css('height','0px');
                $('#box').css('opacity','0');
                down = false;
            }else{
                if(clear) {
                    $('.notifications-item').html("");
                }
                $('#box').css('height','auto');
                $('#box').css('opacity','1');
                $('#notificationCounter').text("0");
                $.ajax({
                    type: "POST",
                    url: "./utilis/clearNotification.php"
                }).done(function( msg ) {
                    clear = true;
                });
                down = true;
            }
        });
    });
</script>