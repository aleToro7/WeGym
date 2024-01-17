<?php
require_once 'bootstrap.php';

if(isset($_POST["ottieniPostProfilo"])){
    $_SESSION["location"] = "profilo";

}else if(isset($_POST["ottieniPostLike"])){
    $_SESSION["location"] = "like";

}else if (isset($_POST["ottieniPostHome"])){
    $_SESSION["location"] = "home";
}
?>