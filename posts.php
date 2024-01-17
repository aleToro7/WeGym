<?php
require_once 'bootstrap.php';

$results = null;

if(isset($_SESSION["location"])){
    if($_SESSION["location"] == "profilo"){
        $results = $dbh->getMyPost($_SESSION["username"]);

    }else if($_SESSION["location"] == "like"){
        $results = $dbh->getLikedPost($_SESSION["username"]);

    }else if($_SESSION["location"] == "home"){
        $results = $dbh->getFollowingPost($_SESSION["username"]);
    }
}



$i = 0;
foreach ($results as $row){
    $templateParams["post"][$i] = $row;
    $i++;
}

?>