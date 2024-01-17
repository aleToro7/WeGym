<?php 
require_once 'bootstrap.php';
$notifications = $dbh->getNewNotifications($_SESSION['username']);
if(count($notifications)<10){
    $notifications = $dbh->getAllNotifications($_SESSION['username']);
}
if(count($notifications) > 0){
    echo json_encode($notifications);
}
?>