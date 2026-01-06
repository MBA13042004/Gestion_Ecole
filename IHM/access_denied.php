<?php
require_once '../Acces_BD/session_config.php';
$page_title = "Accès Refusé";
include('public/header.php');
include('public/nav_barre.php');
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Accès Refusé
                    </h4>
                </div>
                <div class="card-body text-center">
                    <i class="fas fa-ban fa-5x text-danger mb-4"></i>
                    <h5 class="card-title">Vous n'avez pas les permissions nécessaires</h5>
                    <p class="card-text">
                        <?php 
                        if (isset($_SESSION['message'])) {
                            echo htmlspecialchars($_SESSION['message']);
                            unset($_SESSION['message']);
                        } else {
                            echo "Vous n'êtes pas autorisé à accéder à cette page.";
                        }
                        ?>
                    </p>
                    <hr>
                    <div class="mt-4">
                        <a href="accueil.php" class="btn btn-primary">
                            <i class="fas fa-home me-1"></i>
                            Retour à l'accueil
                        </a>
                        <?php if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'accueil.php') === false): ?>
                            <button onclick="history.back()" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Retour à la page précédente
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="alert alert-info mt-4">
                <h6><i class="fas fa-info-circle me-2"></i>Informations sur les permissions</h6>
                <ul class="mb-0">
                    <li><strong>Étudiants :</strong> Consultation des listes uniquement (lecture seule)</li>
                    <li><strong>Professeurs :</strong> Consultation des listes uniquement (lecture seule)</li>
                    <li><strong>Administrateurs :</strong> Accès complet (création, modification, suppression)</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include('public/footer.php'); ?>
