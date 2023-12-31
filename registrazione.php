<?php
require_once 'bootstrap.php';

$username = "";
if(isset($_POST['username']) || !empty($_POST['username']))
{
   $username = strip_tags(trim($_POST['username']));
   if(strlen($username) < 4 && strlen($username) < 25){
      echo "Il nome utente deve avere un numero di caratteri compreso tra 4 e 25";
   }else{
      $already_taken = $dbh->checkUserName($username);
      if (count($already_taken) > 0) {
         echo "Username not available";
      } else {
         echo "Username available";
      }
   }
}

if(isset($_POST['continua'])){
   //TO DO
}
?>