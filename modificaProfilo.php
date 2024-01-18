<?php
require_once 'bootstrap.php';

if(isset($_POST['imageFromAjax'])) {
    $imgProfilo = $_POST['imageFromAjax'];
    $error = $dbh->addImage($imgProfilo, $_SESSION['username']);

    if($error==''){
        $_SESSION["imgProfilo"] = $imgProfilo;
        echo "ok";
    }else {
        $templateParams["erroreImmagine"] = "Errore durante il caricamento dell'immagine";
    }
}

if(isset($_POST['usernameFromAjax']) && isset($_POST['biografiaFromAjax'])){
    $newUsername = $_POST['usernameFromAjax'];
    $newBiografia = $_POST['biografiaFromAjax'];
    $frequenza = $_POST['frequenza'];
    $obbiettivo = $_POST['obbiettivo'];
    $esercizioPreferito = $_POST['esercizioPreferito'];
    $muscoloPreferito = $_POST['muscoloPreferito'];
    $alimentoPreferito = $_POST['alimentoPreferito'];

    $error = $dbh->updateInfo($newUsername, $newBiografia, $_SESSION['username'], $frequenza, $obbiettivo, $esercizioPreferito, $muscoloPreferito, $alimentoPreferito);
    if($error==''){
        $_SESSION["username"] = $newUsername;
        $_SESSION["biografia"] = $newBiografia;
        echo "ok";
    }else {
        echo "errore";
    }
}

if(isset($_POST['aggiornaOldPswFromAjax']) && isset($_POST['newPasswordFromAjax'])) {
    $oldPsw = strip_tags(trim($_POST['aggiornaOldPswFromAjax']));
    $newPsw = strip_tags(trim($_POST['newPasswordFromAjax']));
    $hash = $dbh->getUser($_SESSION['username'])[0]['password'];
    if(password_verify($oldPsw, $hash)) {
        $hash = password_hash($newPsw, PASSWORD_BCRYPT);
        $err = $dbh->updatePassword($hash, $_SESSION['username']);
        if(empty($err)) {
            echo 'ok';
        }
    }else {
        echo "Errore! Password non corretta.";
    }
}

?>