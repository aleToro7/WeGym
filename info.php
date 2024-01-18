<?php
require_once 'bootstrap.php';

$results = $dbh->getMyInfo($_SESSION["usernameCercato"]);
$i = 0;
foreach ($results as $row){
    $templateParams["myinfo"][$i] = $row;
    $i++;
}
?>