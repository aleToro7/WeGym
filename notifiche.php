<?php 
require_once 'bootstrap.php';
$notifications = $dbh->getNewNotifications($_SESSION['username']);
if(count($notifications) > 0){
    echo json_encode($notifications);
}
?>