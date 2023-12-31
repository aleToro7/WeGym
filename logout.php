<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['nome']);
unset($_SESSION['cognome']);
header("location: template/index.php");
?>