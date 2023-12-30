<?php
require_once 'bootstrap.php';

if(isset($_POST['Login'])){
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $enc_password = password_hash($password, PASSWORD_DEFAULT);

        $login_result = $dbh->checkLogin($username, $enc_password);
        if(count($login_result)==0){
            //Login fallito
            $templateParams["errorelogin"] = "Errore! Controllare username o password!";
        }
        else{
            registerLoggedUser($login_result[0]);
        }
    }
}

if(isUserLoggedIn()){
    //TO DO
}else{
    //TO DO
}

require 'template/login-form.php';
?>