<?php

class DatabaseHelper{
    private $db;
    
    public function __construct($servername, $username, $password, $dbname){
        $this->db = new mysqli($servername, $username, $password, $dbname);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    //metodi per query

    public function checkLogin($username, $enc_password){
        $salt = "asd832jiaiodsjioa";
        $salted_pwd = $salt + $enc_password;

        // TO DO
    }
}