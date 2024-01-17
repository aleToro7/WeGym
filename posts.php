<?php
require_once 'bootstrap.php';
$results='';
if(isset($_SESSION["location"])){
    if($_SESSION["location"] == "profilo"){
        $results = $dbh->getMyPost($_SESSION["username"]);

    }else if($_SESSION["location"] == "like"){
        $results = $dbh->getLikedPost($_SESSION["username"]);

    }else if($_SESSION["location"] == "home"){
        $results = $dbh->getFollowingPost($_SESSION["username"]);

    }else if($_SESSION["location"] == "cercato"){
        if(isset($_SESSION["usernameCercato"])){
            $results = $dbh->getSearchedUserPost($_SESSION["username"], $_SESSION["usernameCercato"]);
        }else {
            $results = $dbh->getMyPost($_SESSION["username"]);
        }
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