<?php
require_once 'bootstrap.php';

if(isset($_POST["idNotificaFromAjax"])){
    $dbh->viewNotification($_POST["idNotificaFromAjax"]);
}

if(isset($_POST["ottieniPostProfilo"])){
    if (isset($_SESSION['usernameCercato']) && $_SESSION['usernameCercato'] != $_SESSION['username']){
        $_SESSION["location"] = "cercato";
    }else {
        $_SESSION["location"] = "profilo";
    }

}else if(isset($_POST["ottieniPostMioProfilo"])){
    $_SESSION["location"] = "profilo";
    
}else if(isset($_POST["ottieniPostLike"])){
    $_SESSION["location"] = "like";

}else if (isset($_POST["ottieniPostHome"])){
    if($_POST["ottieniPostHome"] == "chiudi") unset($_SESSION["usernameCercato"]);
    $_SESSION["location"] = "home";
}else if(isset($_POST["idPostFromAjax"])) {
    $_SESSION["location"] = "singlePost";
    $_SESSION["idPost"] = $_POST["idPostFromAjax"];
}
?>