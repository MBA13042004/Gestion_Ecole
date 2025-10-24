<?php
session_start();
require_once '../Acces_BD/Login.php';

$login = new Login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $_SESSION['message'] = 'Veuillez remplir tous les champs.';
        header('Location: ../index.php');
        exit();
    }
    
    if ($login->login($username, $password)) {
        $_SESSION['message'] = 'Connexion réussie ! Bienvenue ' . htmlspecialchars($username) . '.';
        header('Location: ../IHM/accueil.php');
        exit();
    } else {
        $_SESSION['message'] = 'Nom d\'utilisateur ou mot de passe incorrect.';
        header('Location: ../index.php');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>
