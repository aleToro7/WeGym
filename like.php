<?php
require_once 'bootstrap.php';

if(isset($_POST["mettiLike"]) && isset($_POST["ownerPostLike"])){
    $idPost = $_POST["mettiLike"];
    $ownerPost = $_POST["ownerPostLike"];
    $error = $dbh->mettiLike($_SESSION["username"], $idPost, $ownerPost);
    echo $error;
}
if(isset($_POST["togliLike"]) && isset($_POST["ownerPostLiked"])){
    $idPost = $_POST["togliLike"];
    $ownerPost = $_POST["ownerPostLiked"];
    $error = $dbh->togliLike($_SESSION["username"], $idPost, $ownerPost);
    echo $error;
}

?>