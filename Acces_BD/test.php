<?php
require_once 'connexion.php';

$conn = Connect();

if ($conn) {
    echo "✅ Connexion réussie à la base de données !";
}
