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
    if(isset($_SESSION["biografia"])) {
        $templateParams["biografia"] = $_SESSION["biografia"];
    }else {
        $templateParams["biografia"] = '';
    }
    if(isset($_SESSION["imgProfilo"])) {
        $templateParams["imgProfilo"] = $_SESSION["imgProfilo"];
    }else {
        $templateParams["imgProfilo"] = "";
    }
}
?>