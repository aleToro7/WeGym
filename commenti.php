<?php
require_once 'bootstrap.php';

if(isset($_POST['testoCommentoFromAjax']) && isset($_POST['idPostFromAjax']) && isset($_POST['ownerPostFromAjax'])) {
    $testoCommento = $_POST['testoCommentoFromAjax'];
    $idPost = $_POST['idPostFromAjax'];
    $ownerPost = $_POST['ownerPostFromAjax'];
    $err = $dbh->inserisciCommento($testoCommento, $_SESSION['username'], $idPost, $ownerPost);
    if($err=='') {
        echo json_encode($dbh->searchUser($_SESSION['username']));
    }else {
        echo $err;
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