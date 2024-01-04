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
?>