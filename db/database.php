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

    public function updatePassword($password, $username) {
        $query = "UPDATE utente SET password=? WHERE nomeUtente=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$password, $username);
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

    public function contaFollow($utente) {
        $query = "SELECT COUNT(*) as numeroFollow FROM segue WHERE idUtenteSeguente=?";
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

    public function removeNotification($tipo, $idPost, $utenteSeguito, $utenteSeguente){
        $query = "DELETE FROM notifica WHERE tipo=? AND idPost=? AND idUtenteSeguito=? AND idUtenteSeguente=?";
        $stmt = $this->db->prepare($query);
        $visto = (int)false;
        $stmt->bind_param('siss', $tipo, $idPost, $utenteSeguito, $utenteSeguente);
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
        $query = "INSERT INTO post (testo, img, idUtente) VALUES (?, '".$img."', ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $testo, $idUtente);
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
        $query = "SELECT u.imgProfilo, p.idUtente, p.idPost, p.testo, p.img, COUNT(DISTINCT m.idMiPiace) AS numMiPiace, COUNT(DISTINCT c.idCommento) AS numCommenti FROM
        utente u JOIN post p ON u.nomeUtente = p.idUtente LEFT JOIN mipiace m ON p.idPost = m.idPost LEFT JOIN commento c ON p.idPost = c.idPost WHERE u.nomeUtente = ? 
        GROUP BY u.nomeUtente, u.imgProfilo, p.idPost, p.testo, p.img ORDER BY p.idPost DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $idUtente);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSinglePost($idUtente, $idPost) {
        $query = "SELECT u.imgProfilo, p.idUtente, p.idPost, p.testo, p.img, COUNT(DISTINCT m.idMiPiace) AS numMiPiace, COUNT(DISTINCT c.idCommento) AS numCommenti FROM
        utente u JOIN post p ON u.nomeUtente = p.idUtente LEFT JOIN mipiace m ON p.idPost = m.idPost LEFT JOIN commento c ON p.idPost = c.idPost WHERE u.nomeUtente = ? 
        AND p.idPost = ? GROUP BY u.nomeUtente, u.imgProfilo, p.idPost, p.testo, p.img ORDER BY p.idPost DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $idUtente, $idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getFollowingPost($idUtente) {
        $query = "SELECT u.imgProfilo, p.idUtente, p.idPost, p.testo, p.img, CASE WHEN m.idUtente IS NOT NULL THEN TRUE ELSE FALSE END AS messoLike FROM post p JOIN utente u ON u.nomeUtente = p.idUtente 
        LEFT JOIN mipiace m ON p.idPost = m.idPost AND m.idUtente = ? WHERE p.idUtente IN (SELECT idUtenteSeguito FROM segue WHERE idUtenteSeguente = ?) ORDER BY p.idPost DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $idUtente, $idUtente);
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

    public function getSearchedUserPost($idUtente, $idUtenteCercato) {
        $query = "SELECT u.imgProfilo, p.idUtente, p.idPost, p.testo, p.img, CASE WHEN m.idUtente IS NOT NULL THEN TRUE ELSE FALSE END AS messoLike FROM post p JOIN
         utente u ON u.nomeUtente = p.idUtente LEFT JOIN mipiace m ON p.idPost = m.idPost AND m.idUtente = ? WHERE p.idUtente = ? ORDER BY p.idPost DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $idUtente, $idUtenteCercato);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function inserisciCommento($testo, $idUtente, $idPost, $ownerPost) {
        $query = "INSERT INTO commento (testo, idUtente, idPost) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssi', $testo, $idUtente, $idPost);
        $stmt->execute();
        if(empty($stmt->error) && $idUtente != $ownerPost){
            return $this->addNotification('commento', $idPost, $ownerPost, $idUtente);
        }else {
            return $stmt->error;
        }
    }

    public function mettiLike($idUtente, $idPost, $ownerPost){
        $query = "INSERT INTO mipiace (idUtente, idPost) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $idUtente, $idPost);
        $stmt->execute();
        if(empty($stmt->error)){
            return $this->addNotification('like', $idPost, $ownerPost, $idUtente);
        }else {
            return $stmt->error;
        }
    }

    public function togliLike($idUtente, $idPost, $ownerPost){
        $query = "DELETE FROM mipiace WHERE idUtente=? AND idPost=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $idUtente, $idPost);
        $stmt->execute();
        if(empty($stmt->error)){
            return $this->removeNotification('like', $idPost, $ownerPost, $idUtente);
        }else {
            return $stmt->error;
        }
    }

    public function getComments($idPost) {
        $query = "SELECT u.imgProfilo, c.testo, c.idUtente FROM commento c, utente u WHERE u.nomeUtente=c.idUtente AND c.idPost=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $idPost);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}