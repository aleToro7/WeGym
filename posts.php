<?php
require_once 'bootstrap.php';

if(isset($_SESSION["location"])){
    if($_SESSION["location"] == "profilo"){
        $results = $dbh->getMyPost($_SESSION["username"]);

    }else if($_SESSION["location"] == "like"){
        $results = $dbh->getLikedPost($_SESSION["username"]);

    }else if($_SESSION["location"] == "home"){
        $results = $dbh->getFollowingPost($_SESSION["username"]);

    }else if($_SESSION["location"] == "cercato" && isset($_SESSION["usernameCercato"])){
        $results = $dbh->getMyPost($_SESSION["usernameCercato"]);
    }
    
    $i = 0;
    foreach ($results as $row){
        $templateParams["post"][$i] = $row;
        $i++;
    }
}

if(isset($_POST['loadCommentsOf'])) {
    echo $_POST['loadCommentsOf'];
    $_SESSION['idPost'] = $_POST['loadCommentsOf'];
}
?>