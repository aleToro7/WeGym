<?php
function registerLoggedUser($user){
    $_SESSION["username"] = $user["username"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["cognome"] = $user["cognome"];
}

function isUserLoggedIn(){
    return !empty($_SESSION['username']);
}
?>