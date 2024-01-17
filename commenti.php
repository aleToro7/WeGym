<?php
require_once 'bootstrap.php';

if(isset($_POST['testoCommentoFromAjax']) && isset($_POST['idPostFromAjax'])) {
    $testoCommento = $_POST['testoCommentoFromAjax'];
    $idPost = $_POST['idPostFromAjax'];
    $err = $dbh->inserisciCommento($testoCommento, $_SESSION['username'], $idPost);
    if($err=='') {
        echo json_encode($dbh->searchUser($_SESSION['username']));
    }
}

if(isset($_SESSION['idPost'])) {
    $comments = $dbh->getComments($_SESSION['idPost']);
    if(count($comments)>0) {
        $i = 0;
        foreach($comments as $comment) {
            $templateParams['comment'][$i] = $comment;
            $i++;
        }
    };
}
?>