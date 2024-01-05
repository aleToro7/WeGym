<?php
require_once 'bootstrap.php';

if(isset($_POST["cercaFromAjax"])) {
    $userCercato = strip_tags(trim($_POST['cercaFromAjax']));
    $results = $dbh->searchUser($userCercato);
    if (count($results) > 0) {
        echo json_encode($results);
    }else {
        echo "Nessun utente trovato";
    }
}

if(isset($_POST["idCercatoFromAjax"])) {
    $userCercato = $_POST['idCercatoFromAjax'];
    $_SESSION["usernameCercato"] = $userCercato;
    echo "ok";
}
?>