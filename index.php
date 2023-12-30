<?php
require_once 'bootstrap.php';

if(isset($_POST['Login'])){
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $enc_password = password_hash($password, PASSWORD_DEFAULT);

        $dbh->checkLogin($username, $enc_password);
    }
}




require 'template/login-form.php'
?>