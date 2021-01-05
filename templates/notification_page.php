<link rel="stylesheet" href="./css/notification/notification.css" />


<div class="icon" id="bell">
    <span id="outCounter" class="badge badge-pill red">
        <?php echo $notificationCount; ?>
    </span>
    <img src="https://i.imgur.com/AC7dgLA.png" alt="">
</div>
<div class="notifications" id="box">
    <span id="titoloNotifica" class="h2 text-left">Notifiche - <span id="inCounter"><?php echo $notificationCount ?></span></span>
    <?php foreach ($allNotification as $notify): ?>
    <div class="notifications-item">
        <div class="text">
            <div class="h4 text-left"><?php echo $notify["nome"] ?></div>
            <p><?php echo $notify["contenuto"] ?></p>
        </div>
    </div>
    <?php endforeach ?>
</div>

<script src="<?php echo JS_FILE . $jsFileName ?>"></script>