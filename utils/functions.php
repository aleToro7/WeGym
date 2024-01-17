<?php

function registerLoggedUser($user){
    $_SESSION["username"] = $user["nomeUtente"];
    $_SESSION["location"] = "home";
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["cognome"] = $user["cognome"];
    $_SESSION["mail"] = $user["mail"];
    $_SESSION["dataNascita"] = $user["dataNascita"];
    if($user["biografia"] != '') {
        $_SESSION["biografia"] = $user["biografia"];
    }else {
        $_SESSION["biografia"] = '';
    }
    if($user["imgProfilo"] != '') {
        $_SESSION["imgProfilo"] = $user["imgProfilo"];
    }else {
        $_SESSION["imgProfilo"] = "";
    }
}

function isUserLoggedIn(){
    return !empty($_SESSION['username']);
}
?>