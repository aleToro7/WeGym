<?php
require_once 'bootstrap.php';

if(isset($_POST["ottieniPostProfilo"])){
    if (isset($_SESSION['usernameCercato'])){
        $_SESSION["location"] = "cercato";
    }else {
        $_SESSION["location"] = "profilo";
    }

}else if(isset($_POST["ottieniPostLike"])){
    $_SESSION["location"] = "like";

}else if (isset($_POST["ottieniPostHome"])){
    if($_POST["ottieniPostHome"] == "chiudi") unset($_SESSION["usernameCercato"]);
    $_SESSION["location"] = "home";
}
?>