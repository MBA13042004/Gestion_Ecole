<?php
require_once '../Acces_BD/session_config.php';
require_once '../Acces_BD/Etudiant.php';

// Vérifier la connexion
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    $_SESSION['message'] = 'Vous devez être connecté pour accéder à cette page.';
    header('Location: ../index.php');
    exit();
}

// Vérifier les permissions - Seuls les administrateurs peuvent gérer les étudiants
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = 'Seuls les administrateurs peuvent gérer les étudiants.';
    header('Location: ../IHM/accueil.php');
    exit();
}

$etudiant = new Etudiant();
$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telephone = trim($_POST['telephone'] ?? '');
            $date_naissance = $_POST['date_naissance'] ?? '';
            $niveau = trim($_POST['niveau'] ?? '');
            
            if (empty($nom) || empty($prenom)) {
                $_SESSION['message'] = 'Le nom et le prénom sont obligatoires.';
                header('Location: ../IHM/Etudiant/form.php');
                exit();
            }
            
            $result = $etudiant->ajouter($nom, $prenom, $email, $telephone, $date_naissance, $niveau);
            
            if ($result) {
                $_SESSION['message'] = 'Étudiant ajouté avec succès !';
                header('Location: ../IHM/Etudiant/affichage.php');
            } else {
                $_SESSION['message'] = 'Erreur lors de l\'ajout de l\'étudiant.';
                header('Location: ../IHM/Etudiant/form.php');
            }
        }
        break;
        
    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telephone = trim($_POST['telephone'] ?? '');
            $date_naissance = $_POST['date_naissance'] ?? '';
            $niveau = trim($_POST['niveau'] ?? '');
            
            if (empty($id) || empty($nom) || empty($prenom)) {
                $_SESSION['message'] = 'L\'ID, le nom et le prénom sont obligatoires.';
                header('Location: ../IHM/Etudiant/affichage.php');
                exit();
            }
            
            $result = $etudiant->modifier($id, $nom, $prenom, $email, $telephone, $date_naissance, $niveau);
            
            if ($result) {
                $_SESSION['message'] = 'Étudiant modifié avec succès !';
                header('Location: ../IHM/Etudiant/affichage.php');
            } else {
                $_SESSION['message'] = 'Erreur lors de la modification de l\'étudiant.';
                header('Location: ../IHM/Etudiant/form.php?id=' . $id);
            }
        }
        break;
        
    case 'delete':
        $id = $_GET['id'] ?? '';
        
        if (empty($id)) {
            $_SESSION['message'] = 'ID de l\'étudiant manquant.';
            header('Location: ../IHM/Etudiant/affichage.php');
            exit();
        }
        
        $result = $etudiant->supprimer($id);
        
        if ($result) {
            $_SESSION['message'] = 'Étudiant supprimé avec succès !';
        } else {
            $_SESSION['message'] = 'Erreur lors de la suppression de l\'étudiant.';
        }
        
        header('Location: ../IHM/Etudiant/affichage.php');
        break;
        
    default:
        $_SESSION['message'] = 'Action non reconnue.';
        header('Location: ../IHM/Etudiant/affichage.php');
        break;
}
?>
