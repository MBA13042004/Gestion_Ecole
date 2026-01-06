<?php
require_once '../Acces_BD/session_config.php';
require_once '../Acces_BD/Professeur.php';

// Vérifier la connexion
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    $_SESSION['message'] = 'Vous devez être connecté pour accéder à cette page.';
    header('Location: ../index.php');
    exit();
}

// Vérifier les permissions - Seuls les administrateurs peuvent gérer les professeurs
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = 'Seuls les administrateurs peuvent gérer les professeurs.';
    header('Location: ../IHM/accueil.php');
    exit();
}

$professeur = new Professeur();
$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telephone = trim($_POST['telephone'] ?? '');
            $specialite = trim($_POST['specialite'] ?? '');
            $date_embauche = $_POST['date_embauche'] ?? '';
            
            if (empty($nom) || empty($prenom)) {
                $_SESSION['message'] = 'Le nom et le prénom sont obligatoires.';
                header('Location: ../IHM/Prof/form.php');
                exit();
            }
            
            $result = $professeur->ajouter($nom, $prenom, $email, $telephone, $specialite, $date_embauche);
            
            if ($result) {
                $_SESSION['message'] = 'Professeur ajouté avec succès !';
                header('Location: ../IHM/Prof/affichage.php');
            } else {
                $_SESSION['message'] = 'Erreur lors de l\'ajout du professeur.';
                header('Location: ../IHM/Prof/form.php');
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
            $specialite = trim($_POST['specialite'] ?? '');
            $date_embauche = $_POST['date_embauche'] ?? '';
            
            if (empty($id) || empty($nom) || empty($prenom)) {
                $_SESSION['message'] = 'L\'ID, le nom et le prénom sont obligatoires.';
                header('Location: ../IHM/Prof/affichage.php');
                exit();
            }
            
            $result = $professeur->modifier($id, $nom, $prenom, $email, $telephone, $specialite, $date_embauche);
            
            if ($result) {
                $_SESSION['message'] = 'Professeur modifié avec succès !';
                header('Location: ../IHM/Prof/affichage.php');
            } else {
                $_SESSION['message'] = 'Erreur lors de la modification du professeur.';
                header('Location: ../IHM/Prof/form.php?id=' . $id);
            }
        }
        break;
        
    case 'delete':
        $id = $_GET['id'] ?? '';
        
        if (empty($id)) {
            $_SESSION['message'] = 'ID du professeur manquant.';
            header('Location: ../IHM/Prof/affichage.php');
            exit();
        }
        
        $result = $professeur->supprimer($id);
        
        if ($result) {
            $_SESSION['message'] = 'Professeur supprimé avec succès !';
        } else {
            $_SESSION['message'] = 'Erreur lors de la suppression du professeur.';
        }
        
        header('Location: ../IHM/Prof/affichage.php');
        break;
        
    default:
        $_SESSION['message'] = 'Action non reconnue.';
        header('Location: ../IHM/Prof/affichage.php');
        break;
}
?>
