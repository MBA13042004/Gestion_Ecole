<?php
session_start();
$page_title = "Accueil";
include('public/header.php');
include('public/nav_barre.php');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="jumbotron bg-light p-5 rounded">
                <h1 class="display-4">
                    <i class="fas fa-graduation-cap text-primary me-3"></i>
                    Bienvenue dans le système de gestion d'école
                </h1>
                <p class="lead">
                    Gérez efficacement les informations des étudiants et professeurs de votre établissement.
                </p>
                <hr class="my-4">
                
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-graduate fa-3x text-info mb-3"></i>
                                    <h5 class="card-title">Gestion des Étudiants</h5>
                                    <p class="card-text">Consultez, ajoutez, modifiez et supprimez les informations des étudiants.</p>
                                    <a href="Etudiant/affichage.php" class="btn btn-info">
                                        <i class="fas fa-list me-1"></i>Voir les étudiants
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    <i class="fas fa-chalkboard-teacher fa-3x text-success mb-3"></i>
                                    <h5 class="card-title">Gestion des Professeurs</h5>
                                    <p class="card-text">Consultez, ajoutez, modifiez et supprimez les informations des professeurs.</p>
                                    <a href="Prof/affichage.php" class="btn btn-success">
                                        <i class="fas fa-list me-1"></i>Voir les professeurs
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'professeur'): ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body text-center">
                                        <i class="fas fa-user-plus fa-2x text-warning mb-3"></i>
                                        <h5 class="card-title">Ajouter un Étudiant</h5>
                                        <a href="Etudiant/form.php" class="btn btn-warning">
                                            <i class="fas fa-plus me-1"></i>Nouvel étudiant
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body text-center">
                                        <i class="fas fa-user-plus fa-2x text-warning mb-3"></i>
                                        <h5 class="card-title">Ajouter un Professeur</h5>
                                        <a href="Prof/form.php" class="btn btn-warning">
                                            <i class="fas fa-plus me-1"></i>Nouveau professeur
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="alert alert-info">
                        <h4><i class="fas fa-info-circle me-2"></i>Connexion requise</h4>
                        <p>Veuillez vous connecter pour accéder aux fonctionnalités de gestion.</p>
                        <a href="../index.php" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-1"></i>Se connecter
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include('public/footer.php'); ?>
