<?php
require_once '../../Acces_BD/session_config.php';
require_once '../../Acces_BD/Professeur.php';

$page_title = "Liste des Professeurs";
include('../public/header.php');
include('../public/nav_barre.php');

// Vérifier la connexion
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ../../index.php');
    exit();
}

// Les professeurs sont redirigés vers leur profil personnel
if ($_SESSION['role'] === 'professeur') {
    header('Location: mon_profil.php');
    exit();
}

$professeur = new Professeur();
$professeurs = $professeur->afficherTous();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-chalkboard-teacher me-2"></i>Liste des Professeurs</h2>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a href="form.php" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Ajouter un professeur
                    </a>
                <?php endif; ?>
            </div>

            <?php if (empty($professeurs)): ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun professeur trouvé dans la base de données.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover modern-table">
                        <thead class="table-gradient">
                            <tr>
                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <th><i class="fas fa-hashtag me-1"></i>ID</th>
                                <?php endif; ?>
                                <th><i class="fas fa-user me-1"></i>Nom</th>
                                <th><i class="fas fa-user me-1"></i>Prénom</th>
                                <th><i class="fas fa-envelope me-1"></i>Email</th>
                                <th><i class="fas fa-phone me-1"></i>Téléphone</th>
                                <th><i class="fas fa-book-open me-1"></i>Spécialité</th>
                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <th><i class="fas fa-calendar-check me-1"></i>Date d'embauche</th>
                                    <th><i class="fas fa-cog me-1"></i>Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($professeurs as $professeur_data): ?>
                                <tr class="animated-row">
                                    <?php if ($_SESSION['role'] === 'admin'): ?>
                                        <td><?php echo htmlspecialchars($professeur_data['id']); ?></td>
                                    <?php endif; ?>
                                    <td class="fw-bold"><?php echo htmlspecialchars($professeur_data['nom']); ?></td>
                                    <td><?php echo htmlspecialchars($professeur_data['prenom']); ?></td>
                                    <td>
                                        <a href="mailto:<?php echo htmlspecialchars($professeur_data['email']); ?>" class="text-decoration-none">
                                            <i class="fas fa-envelope me-1"></i><?php echo htmlspecialchars($professeur_data['email']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <i class="fas fa-phone me-1 text-muted"></i>
                                        <?php echo htmlspecialchars($professeur_data['telephone'] ?: 'N/A'); ?>
                                    </td>
                                    <td>
                                        <span class="badge-modern badge-specialite">
                                            <?php echo htmlspecialchars($professeur_data['specialite']); ?>
                                        </span>
                                    </td>
                                    <?php if ($_SESSION['role'] === 'admin'): ?>
                                        <td>
                                            <?php 
                                            if ($professeur_data['date_embauche']) {
                                                echo '<i class="fas fa-calendar me-1 text-muted"></i>' . date('d/m/Y', strtotime($professeur_data['date_embauche']));
                                            } else {
                                                echo 'N/A';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="form.php?id=<?php echo $professeur_data['id']; ?>" 
                                                   class="btn btn-sm btn-warning-modern" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="../../Gestion_Actions/Professeur.php?action=delete&id=<?php echo $professeur_data['id']; ?>" 
                                                   class="btn btn-sm btn-danger-modern" 
                                                   title="Supprimer"
                                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce professeur ?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <?php if ($_SESSION['role'] === 'etudiant'): ?>
                    <div class="alert alert-info border-0 shadow-sm mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Mode Consultation Étudiant:</strong> Vous voyez uniquement les informations publiques des professeurs (nom, prénom, email, téléphone, spécialité).
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.modern-table {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.table-gradient {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white !important;
}

.table-gradient th {
    color: white !important;
    font-weight: 600;
    padding: 15px;
    border: none;
}

.animated-row {
    transition: all 0.3s ease;
}

.animated-row:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.badge-specialite {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
}

.btn-warning-modern {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
}

.btn-warning-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(240, 147, 251, 0.4);
    color: white;
}

.btn-danger-modern {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
}

.btn-danger-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(250, 112, 154, 0.4);
    color: white;
}
</style>

<?php include('../public/footer.php'); ?>

