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
    
    $error = $dbh->updateInfo($newUsername, $newBiografia, $_SESSION['username']);
    if($error==''){
        $_SESSION["username"] = $newUsername;
        $_SESSION["biografia"] = $newBiografia;
        echo "ok";
    }else {
        echo "errore";
    }
}
?>