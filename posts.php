<?php
require_once 'bootstrap.php';


$results = $dbh->getFollowingPost($_SESSION["username"]);
$i = 0;
foreach ($results as $row){
    $templateParams["post"][$i] = $row;
    $i++;
}

?>