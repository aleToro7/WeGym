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
        $query = "SELECT nomeUtente, imgProfilo FROM utente WHERE nomeUtente LIKE '".$username."%' LIMIT 4";
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
        if(empty($stmt->error)){
            return $this->addNotification('follow', null, $utenteSeguito, $utenteSeguente);
        }else {
            return $stmt->error;
        }
        
    }

    public function nonSeguireUtente($utenteSeguente, $utenteSeguito) {
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

    public function updateInfo($newUsername, $newBiografia, $username) {
        $query = "UPDATE utente SET nomeUtente=?, biografia=? WHERE nomeUtente=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sss', $newUsername, $newBiografia, $username);
        $stmt->execute();
        return $stmt->error;
    }

    public function addNotification($tipo, $idPost, $utenteSeguito, $utenteSeguente){
        $query = "INSERT INTO notifica (tipo, visto, idPost, idUtenteSeguito, idUtenteSeguente) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $visto = (int)false;
        $stmt->bind_param('siiss', $tipo, $visto, $idPost, $utenteSeguito, $utenteSeguente);
        $stmt->execute();
        return $stmt->error;
    }

    public function getNewNotifications($idUtente) {
        $query = "SELECT u.imgProfilo, n.idNotifica, n.tipo, n.idPost, n.idUtenteSeguito, n.idUtenteSeguente FROM notifica n, utente u WHERE u.nomeUtente=n.idUtenteSeguente AND visto=? AND idUtenteSeguito=? ORDER BY idNotifica DESC";
        $stmt = $this->db->prepare($query);
        $visto = (int)false;
        $stmt->bind_param('is', $visto, $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllNotifications($idUtente) {
        $query = "SELECT u.imgProfilo, n.idNotifica, n.tipo, n.visto, n.idPost, n.idUtenteSeguito, n.idUtenteSeguente FROM notifica n, utente u WHERE u.nomeUtente=n.idUtenteSeguente AND idUtenteSeguito=? ORDER BY idNotifica DESC LIMIT 10";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function viewNotification($idNotification){
        $query = "UPDATE notifica SET visto=1 WHERE idNotifica=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $idNotification);
        $stmt->execute();
        return $stmt->error;
    }

    public function post($testo, $img, $idUtente) {
        $query = "INSERT INTO post (testo, img, idUtente) VALUES ('".$testo."', '".$img."', '".$idUtente."')";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->error;
    }

    public function countPost($idUtente){
        $query = "SELECT COUNT(*) as numeroPost FROM post WHERE idutente=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMyPost($idUtente) {
        $query = "SELECT u.imgProfilo, p.idUtente, p.idPost, p.testo, p.img, COUNT(m.idMiPiace) AS numMiPiace, COUNT(c.idCommento) AS numCommenti FROM utente u JOIN post p ON u.nomeUtente = p.idUtente LEFT JOIN
        mipiace m ON p.idPost = m.idPost LEFT JOIN commento c ON p.idPost = c.idPost WHERE u.nomeUtente = ? GROUP BY
        u.nomeUtente, u.imgProfilo, p.idPost, p.testo, p.img ORDER BY p.idPost DESC;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowingPost($idUtente) {
        $query = "SELECT u.imgProfilo, p.idUtente, p.idPost, p.testo, p.img FROM post p, utente u WHERE p.idUtente IN (SELECT idUtenteSeguito FROM segue WHERE idUtenteSeguente=?)
        AND u.nomeUtente=p.idUtente ORDER BY idPost DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLikedPost($idUtente) {
        $query = "SELECT uu.imgProfilo, p.idUtente, p.idPost, p.testo, p.img FROM post p, utente u, utente uu WHERE p.idPost IN (SELECT idPost FROM mipiace WHERE idUtente=?)
        AND u.nomeUtente=? AND uu.nomeUtente = p.idUtente ORDER BY idPost DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $idUtente, $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function inserisciCommento($testo, $idUtente, $idPost) {
        $query = "INSERT INTO commento (testo, idUtente, idPost) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssi', $testo, $idUtente, $idPost);
        $stmt->execute();
        return $stmt->error;
    }

}