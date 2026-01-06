<?php
/**
 * Configuration centralisée de la session
 * Ce fichier doit être inclus au début de chaque page nécessitant une session
 * Il évite les erreurs de session_start() multiples
 */

// Démarrer la session seulement si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
