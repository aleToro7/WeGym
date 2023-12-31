<?php
session_start();
require_once("db/database.php");
require_once("utils/functions.php");
$dbh = new DatabaseHelper("localhost", "root", "", "wegym", 3306);
?>