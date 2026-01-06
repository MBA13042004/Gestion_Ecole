<?php
require_once '../../Acces_BD/session_config.php';
require_once '../../Acces_BD/Professeur.php';

$page_title = "Mon Profil";
include('../public/header.php');
include('../public/nav_barre.php');

// Vérifier la connexion
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ../../index.php');
    exit();
}

// Vérifier que c'est un professeur
if ($_SESSION['role'] !== 'professeur') {
    $_SESSION['message'] = 'Cette page est réservée aux professeurs.';
    header('Location: ../accueil.php');
    exit();
}

$professeur = new Professeur();
$username = $_SESSION['username'];

// Chercher le professeur par email (basé sur le username)
$all_professors = $professeur->afficherTous();
$professeur_data = null;

foreach ($all_professors as $prof) {
    // Vérifier si l'email contient le username
    if (stripos($prof['email'], $username) !== false ||
        stripos($prof['email'], str_replace('prof', '', $username)) !== false ||
        $prof['email'] === $_SESSION['username'] . '@ecole.fr') {
        $professeur_data = $prof;
        break;
    }
}

if (!$professeur_data) {
    // Si pas trouvé, afficher le premier professeur pour démonstration
    $_SESSION['message'] = 'Profil professeur trouvé pour démonstration. Veuillez lier votre compte.';
    if (!empty($all_professors)) {
        $professeur_data = $all_professors[0];
    } else {
        $_SESSION['message'] = 'Aucune information de professeur trouvée.';
        header('Location: ../accueil.php');
        exit();
    }
}
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- En-tête du profil avec gradient -->
            <div class="profile-header mb-4">
                <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                    <div class="card-body text-white p-5">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <div class="profile-avatar">
                                    <i class="fas fa-user-tie" style="font-size: 100px; opacity: 0.9;"></i>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <h2 class="mb-2">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>
                                    <?php echo htmlspecialchars($professeur_data['prenom'] . ' ' . $professeur_data['nom']); ?>
                                </h2>
                                <p class="mb-1 fs-5">
                                    <i class="fas fa-book me-2"></i>
                                    Spécialité: <strong><?php echo htmlspecialchars($professeur_data['specialite']); ?></strong>
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-user-tag me-2"></i>
                                    Connecté en tant que: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations Personnelles -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                Informations Personnelles
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="info-item mb-3">
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-user me-2"></i>Nom Complet
                                </div>
                                <div class="fs-5 fw-bold">
                                    <?php echo htmlspecialchars($professeur_data['prenom'] . ' ' . $professeur_data['nom']); ?>
                                </div>
                            </div>
                            
                            <div class="info-item mb-3">
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </div>
                                <div class="fs-6">
                                    <a href="mailto:<?php echo htmlspecialchars($professeur_data['email']); ?>" class="text-decoration-none">
                                        <?php echo htmlspecialchars($professeur_data['email']); ?>
                                    </a>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-phone me-2"></i>Téléphone
                                </div>
                                <div class="fs-6">
                                    <?php echo htmlspecialchars($professeur_data['telephone'] ?: 'Non renseigné'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-briefcase me-2"></i>
                                Informations Professionnelles
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="info-item mb-3">
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-book-open me-2"></i>Spécialité
                                </div>
                                <div class="fs-5">
                                    <span class="badge bg-success fs-6">
                                        <?php echo htmlspecialchars($professeur_data['specialite']); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="info-item mb-3">
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-id-badge me-2"></i>Numéro Professeur
                                </div>
                                <div class="fs-6">
                                    <code class="bg-light p-2 rounded">PROF-<?php echo str_pad($professeur_data['id'], 6, '0', STR_PAD_LEFT); ?></code>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-calendar-check me-2"></i>Date d'Embauche
                                </div>
                                <div class="fs-6">
                                    <?php 
                                    if ($professeur_data['date_embauche']) {
                                        echo date('d/m/Y', strtotime($professeur_data['date_embauche']));
                                    } else {
                                        echo 'Non renseignée';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alerte informative -->
            <div class="alert alert-info border-0 shadow-sm">
                <h6 class="alert-heading">
                    <i class="fas fa-info-circle me-2"></i>
                    Mode Consultation
                </h6>
                <p class="mb-0">
                    Vous consultez votre profil personnel. Pour toute modification de vos informations, veuillez contacter l'administration.
                </p>
            </div>

            <!-- Boutons d'action -->
            <div class="row text-center mt-4">
                <div class="col-md-6 mb-3">
                    <a href="../Etudiant/affichage.php" class="btn btn-lg btn-info shadow w-100">
                        <i class="fas fa-user-graduate me-2"></i>
                        Voir Mes Étudiants
                    </a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="../accueil.php" class="btn btn-lg btn-primary shadow w-100">
                        <i class="fas fa-home me-2"></i>
                        Retour à l'accueil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-header .card {
    border-radius: 20px;
    overflow: hidden;
}

.info-item {
    padding: 10px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.info-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.card {
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

.badge {
    padding: 8px 16px;
}
</style>

<?php include('../public/footer.php'); ?>
