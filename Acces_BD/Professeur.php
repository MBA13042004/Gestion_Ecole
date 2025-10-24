<?php
require_once 'connexion.php';

class Professeur {
    private $conn;

    public function __construct() {
        $this->conn = Connect();
    }

    // Afficher tous les professeurs
    public function afficherTous() {
        $sql = "SELECT * FROM professeurs ORDER BY nom ASC";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    // Afficher un professeur par ID
    public function afficherParId($id) {
        $sql = "SELECT * FROM professeurs WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    // Ajouter un nouveau professeur
    public function ajouter($nom, $prenom, $email, $telephone, $specialite, $date_embauche) {
        $sql = "INSERT INTO professeurs (nom, prenom, email, telephone, specialite, date_embauche) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $nom, $prenom, $email, $telephone, $specialite, $date_embauche);
        
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    // Modifier un professeur
    public function modifier($id, $nom, $prenom, $email, $telephone, $specialite, $date_embauche) {
        $sql = "UPDATE professeurs SET nom=?, prenom=?, email=?, telephone=?, specialite=?, date_embauche=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nom, $prenom, $email, $telephone, $specialite, $date_embauche, $id);
        
        return $stmt->execute();
    }

    // Supprimer un professeur
    public function supprimer($id) {
        $sql = "DELETE FROM professeurs WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        return $stmt->execute();
    }

    // Rechercher des professeurs
    public function rechercher($terme) {
        $sql = "SELECT * FROM professeurs WHERE nom LIKE ? OR prenom LIKE ? OR specialite LIKE ?";
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
