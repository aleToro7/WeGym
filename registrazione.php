<?php
require_once 'bootstrap.php';

$username = "";
if(isset($_POST['username']) || !empty($_POST['username']))
{
   $username = strip_tags(trim($_POST['username']));
   if(strlen($username) < 4 && strlen($username) < 25){  //strlen($username) < 4 potenzialmente inutile dato che non viene effettuato il post finche non viene inserito il 4 carattere
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

$mail = "";
if(isset($_POST['mail']) || !empty($_POST['mail']))
{
   $mail = strip_tags(trim($_POST['mail']));
   $already_used = $dbh->checkMail($mail);
   if (count($already_used) > 0) {
      echo "Mail not available";
   } else {
      echo "Mail available";
   }
}
?>