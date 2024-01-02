<?php

function registerLoggedUser($user){
    $_SESSION["username"] = $user["nomeUtente"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["cognome"] = $user["cognome"];
    $_SESSION["mail"] = $user["mail"];
    $_SESSION["dataNascita"] = $user["dataNascita"];
    //anche img profilo
}

function isUserLoggedIn(){
    return !empty($_SESSION['username']);
}
?>