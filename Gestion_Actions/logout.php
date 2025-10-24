<?php
session_start();
require_once '../Acces_BD/Login.php';

$login = new Login();
$login->logout();

$_SESSION['message'] = 'Vous avez été déconnecté avec succès.';
header('Location: ../index.php');
exit();
?>
