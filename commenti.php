<?php
require_once 'bootstrap.php';

if(isset($_POST['testoCommentoFromAjax']) && isset($_POST['idPostFromAjax'])) {
    $testoCommento = $_POST['testoCommentoFromAjax'];
    $idPost = $_POST['idPostFromAjax'];
    $err = $dbh->inserisciCommento($testoCommento, $_SESSION['username'], $idPost);
}
?>