<?php
require_once 'bootstrap.php';

if(false){
    $results = $dbh->getMyPost($_SESSION["username"]);
}else if(false){
    $results = $dbh->getLikedPost($_SESSION["username"]);
} else{
    $results = $dbh->getFollowingPost($_SESSION["username"]);
}

$i = 0;
foreach ($results as $row){
    $templateParams["post"][$i] = $row;
    $i++;
}

?>