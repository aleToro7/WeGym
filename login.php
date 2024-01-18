<?php
require_once 'bootstrap.php';


if(isset($_POST['username']) && isset($_POST['password'])){
    $username = strip_tags(trim($_POST['username']));
    $password = strip_tags(trim($_POST['password']));

    $login_result = $dbh->getUser($username);
    
    if(count($login_result)==0){
        //Login fallito
        echo "Errore! Username o password non corretti";
    }else {
        $hash = $login_result[0]['password'];
        if(password_verify($password, $hash)) {
            registerLoggedUser($login_result[0]);
            echo "ok";
        }else {
            echo "Errore! Username o password non corretti";
        }
    }
}

?>