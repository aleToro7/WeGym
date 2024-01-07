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

    public function getUser($username){
        $query = "SELECT * FROM utente WHERE nomeUtente = ?";  //bisogna avere tutti i parametri dell'utente
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkUserName($username){
        $query = "SELECT nomeUtente, nome, cognome FROM utente WHERE nomeUtente = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkMail($mail){
        $query = "SELECT nomeUtente, nome, cognome FROM utente WHERE mail = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$mail);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function register($username, $mail, $nome, $cognome, $dataNascita, $password){
        $query = "INSERT INTO utente (nomeUtente, mail, password, nome, cognome, dataNascita) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss',$username, $mail, $password, $nome, $cognome, $dataNascita);
        $stmt->execute();
        return $stmt->error;
    }

    public function searchUser($username) {
        $query = "SELECT nomeUtente FROM utente WHERE nomeUtente LIKE '".$username."%' LIMIT 4";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addImage($imgProfilo, $username){
        $query = "UPDATE utente SET imgProfilo='".$imgProfilo."' WHERE nomeUtente='".$username."'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->error;
    }

    public function seguiUtente($utenteSeguito, $utenteSeguente) {
        $query = "INSERT INTO segue (idUtenteSeguente, idUtenteSeguito) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $utenteSeguente, $utenteSeguito);
        $stmt->execute();
        return $stmt->error;
    }

    public function nonSeguireUtente($utenteSeguito, $utenteSeguente) {
        $query = "DELETE FROM segue WHERE idUtenteSeguente=? AND idUtenteSeguito=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $utenteSeguente, $utenteSeguito);
        $stmt->execute();
        return $stmt->error;
    }

    public function contaFollower($utente) {
        $query = "SELECT COUNT(*) as numeroFollower FROM segue WHERE idUtenteSeguito=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $utente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function controllaFollow($utenteSeguente, $utenteSeguito) {
        $query = "SELECT COUNT(*) as follow FROM segue WHERE idUtenteSeguente=? AND idUtenteSeguito=? ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $utenteSeguente, $utenteSeguito);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}