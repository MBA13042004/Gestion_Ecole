<?php
require_once 'connexion.php';

class Etudiant {
    private $conn;

    public function __construct() {
        $this->conn = Connect();
    }

    // Afficher tous les étudiants
    public function afficherTous() {
        $sql = "SELECT * FROM etudiants ORDER BY nom ASC";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    // Afficher un étudiant par ID
    public function afficherParId($id) {
        $sql = "SELECT * FROM etudiants WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    // Afficher un étudiant par user_id (pour le profil personnel)
    public function afficherParUserId($user_id) {
        $sql = "SELECT * FROM etudiants WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    // Ajouter un nouvel étudiant
    public function ajouter($nom, $prenom, $email, $telephone, $date_naissance, $niveau) {
        $sql = "INSERT INTO etudiants (nom, prenom, email, telephone, date_naissance, niveau) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $nom, $prenom, $email, $telephone, $date_naissance, $niveau);
        
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    // Modifier un étudiant
    public function modifier($id, $nom, $prenom, $email, $telephone, $date_naissance, $niveau) {
        $sql = "UPDATE etudiants SET nom=?, prenom=?, email=?, telephone=?, date_naissance=?, niveau=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nom, $prenom, $email, $telephone, $date_naissance, $niveau, $id);
        
        return $stmt->execute();
    }

    // Supprimer un étudiant
    public function supprimer($id) {
        $sql = "DELETE FROM etudiants WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }

    // Rechercher des étudiants
    public function rechercher($terme) {
        $sql = "SELECT * FROM etudiants WHERE nom LIKE ? OR prenom LIKE ? OR niveau LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $terme = "%$terme%";
        $stmt->bind_param("sss", $terme, $terme, $terme);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
