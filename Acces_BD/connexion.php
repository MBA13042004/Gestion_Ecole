<?php
function Connect()
{
    // Priorité aux variables d'environnement Docker
    $server = getenv('DB_HOST') ?: 'localhost';
    $user = getenv('DB_USERNAME') ?: 'root';
    $password = getenv('DB_PASSWORD') ?: '';
    $dbname = getenv('DB_DATABASE') ?: 'gestion_ecole';
    
    // Fallback: Lire le fichier .env si les variables d'environnement ne sont pas définies
    if (!getenv('DB_HOST') && file_exists(__DIR__ . "/.env")) {
        $env = parse_ini_file(__DIR__ . "/.env");
        $server = $env['serveur'] ?? 'localhost';
        $user = $env['utilisateur'] ?? 'root';
        $password = $env['password'] ?? '';
        $dbname = $env['db_name'] ?? 'gestion_ecole';
    }

    // Créer la connexion
    $conn = new mysqli($server, $user, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        error_log("❌ Échec de la connexion MySQL: " . $conn->connect_error);
        die("❌ Échec de la connexion à la base de données. Veuillez contacter l'administrateur.");
    }

    // Retourner la connexion
    return $conn;
}

