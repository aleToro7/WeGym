<?php

function registerLoggedUser($user){
    $_SESSION["username"] = $user["nomeUtente"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["cognome"] = $user["cognome"];
    $_SESSION["mail"] = $user["mail"];
    $_SESSION["dataNascita"] = $user["dataNascita"];
    $_SESSION["biografia"] = $user["biografia"];
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