<?php
require_once 'bootstrap.php';

if(isset($_POST["mettiLike"])){
    $idPost = $_POST["mettiLike"];
    $error = $dbh->mettiLike($_SESSION["username"], $idPost);
    echo $error;
}
if(isset($_POST["togliLike"])){
    $idPost = $_POST["togliLike"];
    $error = $dbh->togliLike($_SESSION["username"], $idPost);
    echo $error;
}

?>