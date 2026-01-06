<?php
require_once 'connexion.php';

class Login {
    private $conn;

    public function __construct() {
        $this->conn = Connect();
    }

    // Fonction de connexion
    public function login($username, $password) {
        $sql = "SELECT * FROM utilisateurs WHERE username = ? AND password = MD5(?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Définir les variables de session (la session est déjà démarrée par le contrôleur)
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;
            
            return true;
        }
        return false;
    }

    // Fonction de déconnexion
    public function logout() {
        session_destroy();
        return true;
    }

    // Vérifier si l'utilisateur est connecté
    public function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    // Obtenir le rôle de l'utilisateur connecté
    public function getUserRole() {
        return isset($_SESSION['role']) ? $_SESSION['role'] : null;
    }

    // Obtenir l'ID de l'utilisateur connecté
    public function getUserId() {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }

    // Vérifier les permissions
    public function hasPermission($required_role) {
        $user_role = $this->getUserRole();
        
        $hierarchy = ['etudiant' => 1, 'professeur' => 2, 'admin' => 3];
        
        if (!isset($hierarchy[$user_role]) || !isset($hierarchy[$required_role])) {
            return false;
        }
        
        return $hierarchy[$user_role] >= $hierarchy[$required_role];
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
