<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
    header("location: index.php");
    exit;
}else {
    if(isset($_SESSION["usernameCercato"])) {
        $userCercato = $_SESSION["usernameCercato"];
        $user = $dbh->getUser($userCercato);
        if(count($user) > 0) {
            
            $templateParams["username"] = $user[0]["nomeUtente"];
            $templateParams["nome"] = $user[0]["nome"];
            $templateParams["cognome"] = $user[0]["cognome"];
            $templateParams["mail"] = $user[0]["mail"];
            $templateParams["dataNascita"] = $user[0]["dataNascita"];
            if(isset($user[0]["biografia"])) {
                $templateParams["biografia"] = $user[0]["biografia"];
            }else {
                $templateParams["biografia"] = '';
            }
            if(isset($user["imgProfilo"])) {
                $templateParams["imgProfilo"] = $user[0]["imgProfilo"];
            }else {
                $templateParams["imgProfilo"] = "";
            }
            unset($_SESSION["usernameCercato"]);
        }
    }else {
        if(!isset($templateParams["username"])){   
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
    }
}
?>