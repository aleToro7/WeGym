<?php

require_once 'bootstrap.php';

    if(!isset($_SESSION["username"])){
        header("location: index.php");
        exit;
    }
    echo '<a class="btn-getstarted scrollto" href="../logout.php">Disconnettiti</a>';
    echo $_SESSION["username"],  $_SESSION["nome"], $_SESSION["cognome"];

?>