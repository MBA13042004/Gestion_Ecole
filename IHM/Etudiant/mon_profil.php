<?php
require_once '../../Acces_BD/session_config.php';
require_once '../../Acces_BD/Etudiant.php';

$page_title = "Mon Profil";
include('../public/header.php');
include('../public/nav_barre.php');

// Vérifier la connexion
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ../../index.php');
    exit();
}

// Vérifier que c'est un étudiant
if ($_SESSION['role'] !== 'etudiant') {
    $_SESSION['message'] = 'Cette page est réservée aux étudiants.';
    header('Location: ../accueil.php');
    exit();
}

$etudiant = new Etudiant();
$username = $_SESSION['username'];

// Chercher l'étudiant par email (basé sur le username)
// Pattern: username 'etudiant1' -> email contient 'etudiant' ou username directement dans email
$all_students = $etudiant->afficherTous();
$etudiant_data = null;

foreach ($all_students as $student) {
    // Vérifier si l'email contient le username ou si le username correspond
    if (stripos($student['email'], $username) !== false || 
        stripos($student['email'], str_replace('etudiant', '', $username)) !== false ||
        $student['email'] === $_SESSION['username'] . '@student.ecole.fr') {
        $etudiant_data = $student;
        break;
    }
}

if (!$etudiant_data) {
    // Si pas trouvé par email, afficher le premier étudiant pour démonstration
    $_SESSION['message'] = 'Profil étudiant trouvé pour démonstration. Veuillez lier votre compte à un étudiant.';
    if (!empty($all_students)) {
        $etudiant_data = $all_students[0]; // Premier étudiant pour démonstration
    } else {
        $_SESSION['message'] = 'Aucune information d\'étudiant trouvée.';
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
                <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body text-white p-5">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <div class="profile-avatar">
                                    <i class="fas fa-user-circle" style="font-size: 100px; opacity: 0.9;"></i>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <h2 class="mb-2">
                                    <i class="fas fa-id-card me-2"></i>
                                    <?php echo htmlspecialchars($etudiant_data['prenom'] . ' ' . $etudiant_data['nom']); ?>
                                </h2>
                                <p class="mb-1 fs-5">
                                    <i class="fas fa-graduation-cap me-2"></i>
                                    Niveau: <strong><?php echo htmlspecialchars($etudiant_data['niveau']); ?></strong>
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
                        <div class="card-header bg-primary text-white">
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
                                    <?php echo htmlspecialchars($etudiant_data['prenom'] . ' ' . $etudiant_data['nom']); ?>
                                </div>
                            </div>
                            
                            <div class="info-item mb-3">
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </div>
                                <div class="fs-6">
                                    <a href="mailto:<?php echo htmlspecialchars($etudiant_data['email']); ?>" class="text-decoration-none">
                                        <?php echo htmlspecialchars($etudiant_data['email']); ?>
                                    </a>
                                </div>
                            </div>

                            <div class="info-item mb-3">
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-phone me-2"></i>Téléphone
                                </div>
                                <div class="fs-6">
                                    <?php echo htmlspecialchars($etudiant_data['telephone'] ?: 'Non renseigné'); ?>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-birthday-cake me-2"></i>Date de Naissance
                                </div>
                                <div class="fs-6">
                                    <?php 
                                    if ($etudiant_data['date_naissance']) {
                                        echo date('d/m/Y', strtotime($etudiant_data['date_naissance']));
                                    } else {
                                        echo 'Non renseignée';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-book me-2"></i>
                                Informations Académiques
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="info-item mb-3">
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-layer-group me-2"></i>Niveau d'Études
                                </div>
                                <div class="fs-5">
                                    <span class="badge bg-success fs-6">
                                        <?php echo htmlspecialchars($etudiant_data['niveau']); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="info-item mb-3">
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-id-badge me-2"></i>Numéro Étudiant
                                </div>
                                <div class="fs-6">
                                    <code class="bg-light p-2 rounded">ETU-<?php echo str_pad($etudiant_data['id'], 6, '0', STR_PAD_LEFT); ?></code>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="text-muted small mb-1">
                                    <i class="fas fa-calendar-plus me-2"></i>Inscrit Depuis
                                </div>
                                <div class="fs-6">
                                    <?php 
                                    if (isset($etudiant_data['created_at'])) {
                                        echo date('d/m/Y', strtotime($etudiant_data['created_at']));
                                    } else {
                                        echo 'Information non disponible';
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

            <!-- Bouton retour -->
            <div class="text-center mt-4">
                <a href="../accueil.php" class="btn btn-lg btn-primary shadow">
                    <i class="fas fa-home me-2"></i>
                    Retour à l'accueil
                </a>
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
