<?php
require_once 'bootstrap.php';
if(isset($_POST["registrati"])) {
   $username = $_POST["username"];
   $mail = $_POST["mail"];
   $nome = $_POST["nome"];
   $cognome = $_POST["cognome"];
   $dataNascita = $_POST["dataNascita"];
   $password = $_POST["pwd"];

   $hash = password_hash($password, PASSWORD_BCRYPT);
   $error = $dbh->register($username, $mail, $nome, $cognome, $dataNascita, $hash);
   
   if($error==''){
      $_SESSION["username"] = $username;
      $_SESSION["nome"] = $nome;
      $_SESSION["cognome"] = $cognome;
      $_SESSION["mail"] = $mail;
      $_SESSION["dataNascita"] = $dataNascita;

      header("location: base.php");
   }else {
      $templateParams["erroreRegistrazione"] = "Errore durante la registrazione";
   }
}else {
   $username = "";
   if(isset($_POST['usernameFromAjax']) || !empty($_POST['usernameFromAjax']))
   {
      $username = strip_tags(trim($_POST['usernameFromAjax']));
      if(strlen($username) < 4 && strlen($username) < 25){  //strlen($username) < 4 potenzialmente inutile dato che non viene effettuato il post finche non viene inserito il 4 carattere
         echo "Il nome utente deve avere un numero di caratteri compreso tra 4 e 25";
      }else{
         $already_taken = $dbh->checkUserName($username);
         if (count($already_taken) > 0) {
            echo "Username non disponibile";
         } else {
            echo "Username disponibile";
         }
      }
   }

   $mail = "";
   if(isset($_POST['mailFromAjax']) || !empty($_POST['mailFromAjax']))
   {
      $mail = strip_tags(trim($_POST['mailFromAjax']));

      $already_used = $dbh->checkMail($mail);
      if (count($already_used) > 0) {
         echo "Mail non disponibile";
      } else {
         echo "Mail disponibile";
      }
   }
}
?>