<?php

function registerLoggedUser($user){
    $_SESSION["username"] = $user["nomeUtente"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["cognome"] = $user["cognome"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['username']) && !empty($_SESSION['nome']) && !empty($_SESSION['nome']);
}
?>