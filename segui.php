<?php
require_once 'bootstrap.php';
if(isset($_POST["eseguiFromAjax"]) && isset($_POST["seguitoFromAjax"])) {
    $azione = $_POST["eseguiFromAjax"];
    $utenteSeguito = $_POST["seguitoFromAjax"];
    $utenteSeguente = $_SESSION["username"];

    if($azione == "segui") {
        $err = $dbh->seguiUtente($utenteSeguito, $utenteSeguente);
        $followers = $dbh->contaFollower($utenteSeguito);
        if(count($followers) > 0) {
            $_SESSION["followerUsernameCercato"] = $followers[0]['numeroFollower'];
            echo $_SESSION["followerUsernameCercato"];
        }
        
    }else {
        $err = $dbh->nonSeguireUtente($utenteSeguente, $utenteSeguito);
        $followers = $dbh->contaFollower($utenteSeguito);
        if(empty($err)) {
            $_SESSION["followerUsernameCercato"] = $followers[0]['numeroFollower'];
            echo $_SESSION["followerUsernameCercato"];
        }
    }
}
?>