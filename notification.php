<?php

require_once("./macro.php");
require_once("./utilis/NotificationManager.php");
require_once("./utilis/UserManager.php");

$notificationManager = new NotificationManager(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
$userManager = new UserManager(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

$notificationCount = $notificationManager->getNotificationCount($userManager->getEmail());
$allNotification = $notificationManager->getAllNotification($userManager->getEmail());

require("./templates/notification_page.php");

?>