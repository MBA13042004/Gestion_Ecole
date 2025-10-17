<?php
function Connect()
{
    // Lire le fichier .env
    $env = parse_ini_file(__DIR__ . "/.env");

    // Récupérer les paramètres
    $server = $env['Serveur'];
    $user = $env['Utilisateur'];
    $password = $env['Password'];
    $dbname = $env['db_name'];

    // Créer la connexion
    $conn = new mysqli($server, $user, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("❌ Échec de la connexion : " . $conn->connect_error);
    }

    // Retourner la connexion
    return $conn;
}
