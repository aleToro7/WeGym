<?php
require_once 'bootstrap.php';


if(isset($_POST['username']) && isset($_POST['password'])){
    $username = strip_tags(trim($_POST['username']));
    $password = strip_tags(trim($_POST['password']));

    //$enc_password = password_hash($password, PASSWORD_DEFAULT);

    $login_result = $dbh->checkLogin($username, $password);
    //$login_result = $dbh->checkLogin($username, $enc_password);

    if(count($login_result)==0){
        //Login fallito
        echo "Errore! Username o password non corretti.";
    }else {
        registerLoggedUser($login_result[0]);
        echo "ok";
    }
}

?>