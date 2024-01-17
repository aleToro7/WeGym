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
    if(isset($_POST["idNotifica"])){
        $dbh->viewNotification($_POST["idNotifica"]);
    }
    $userCercato = $_POST['idCercatoFromAjax'];
    $_SESSION["usernameCercato"] = $userCercato;
    $_SESSION["location"] = "cercato";
    $posts = $dbh->countPost($userCercato);
    $followers = $dbh->contaFollower($userCercato);
    $follow = $dbh->contaFollow($userCercato);
    if(count($followers) > 0) {
        $_SESSION["postsUsernameCercato"] = $posts[0]['numeroPost'];
    }
    if(count($followers) > 0) {
        $_SESSION["followerUsernameCercato"] = $followers[0]['numeroFollower'];
    }
    if(count($followers) > 0) {
        $_SESSION["followUsernameCercato"] = $follow[0]['numeroFollow'];
    }
    echo $_SESSION['username'];
}
?>