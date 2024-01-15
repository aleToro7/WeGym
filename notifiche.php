<?php 
require_once 'bootstrap.php';
$notifications = $dbh->getNewNotifications();
if(count($notifications) > 0){
    echo json_encode($notifications);
}
?>