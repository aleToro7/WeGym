<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
    header("location: index.php");
    exit;
}else {
    $templateParams["username"] = $_SESSION["username"];
    $templateParams["nome"] = $_SESSION["nome"];
    $templateParams["cognome"] = $_SESSION["cognome"];
    $templateParams["mail"] = $_SESSION["mail"];
    $templateParams["dataNascita"] = $_SESSION["dataNascita"];
    $templateParams["biografia"] = $_SESSION["biografia"];
}

?>