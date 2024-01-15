<?php
require_once 'bootstrap.php';

if(isset($_POST["testoFromAjax"]) && isset($_POST["imgFromAjax"])){
    $err = $dbh->post($_POST["testoFromAjax"], $_POST["imgFromAjax"], $_SESSION["username"]);
    if(empty($err)) {
        echo "ok";
    }
}
?>