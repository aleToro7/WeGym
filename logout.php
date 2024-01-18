<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['imgProfilo']);
unset($_SESSION['location']);
unset($_SESSION['usernameCercato']);
unset($_SESSION['nome']);
unset($_SESSION['cognome']);
unset($_SESSION['mail']);
unset($_SESSION['dataNascita']);
unset($_SESSION['biografia']);
unset($_SESSION["postsUsernameCercato"]);
unset($_SESSION["followerUsernameCercato"]);
unset($_SESSION["followUsernameCercato"]);
header("location: template/index.php");
?>