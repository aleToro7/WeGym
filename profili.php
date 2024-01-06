<?php
require_once 'bootstrap.php';

if(!isset($_SESSION["username"])){
    header("location: index.php");
    exit;
}else {
    if(isset($_SESSION["usernameCercato"])) {
        $follower = $_SESSION["followerUsernameCercato"];
        /*if(!isset($_SESSION["followerUsernameCercato"])) {
            $follower = $dbh->contaFollower($_SESSION["usernameCercato"])[0]['numeroFollower'];
        }else {
            
        }*/
        $userCercato = $_SESSION["usernameCercato"];
        $user = $dbh->getUser($userCercato);
        if(count($user) > 0) {
            $templateParams["username"] = $user[0]["nomeUtente"];
            $templateParams["nome"] = $user[0]["nome"];
            $templateParams["cognome"] = $user[0]["cognome"];
            $templateParams["mail"] = $user[0]["mail"];
            $templateParams["dataNascita"] = $user[0]["dataNascita"];
            $templateParams["follower"] = $follower;
            $templateParams["seguito"] = $dbh->controllaFollow($_SESSION["username"], $userCercato)[0]['follow'] > 0 ? true : false;
            if(isset($user[0]["biografia"])) {
                $templateParams["biografia"] = $user[0]["biografia"];
            }else {
                $templateParams["biografia"] = '';
            }
            if(isset($user[0]["imgProfilo"])) {
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
            $templateParams["follower"] = $dbh->contaFollower($_SESSION["username"])[0]['numeroFollower'];
            $templateParams["seguito"] = false;
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