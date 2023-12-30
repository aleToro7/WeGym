<?php
function registerLoggedUser($user){
    $_SESSION["nomeUtente"] = $user["nomeUtente"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["cognome"] = $user["cognome"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['nomeUtente']);
}
?>