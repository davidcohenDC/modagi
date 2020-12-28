<?php
    require_once("../macro.php");
    require_once("./NotificationManager.php");
    require_once("./utilis/UserManager.php");
    
    $notificationManager = new NotificationManager(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $userManager = new UserManager();
    $notificationManager->clearNotification($userManager->getEmail());
?>