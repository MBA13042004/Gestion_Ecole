<?php
require_once '../../Acces_BD/session_config.php';
require_once '../../Acces_BD/Etudiant.php';

$page_title = "Liste des Étudiants";
include('../public/header.php');
include('../public/nav_barre.php');

// Vérifier la connexion
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ../../index.php');
    exit();
}

// Les étudiants sont redirigés vers leur profil personnel
if ($_SESSION['role'] === 'etudiant') {
    header('Location: mon_profil.php');
    exit();
}

$etudiant = new Etudiant();
$etudiants = $etudiant->afficherTous();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-user-graduate me-2"></i>Liste des Étudiants</h2>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a href="form.php" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Ajouter un étudiant
                    </a>
                <?php endif; ?>
            </div>

            <?php if (empty($etudiants)): ?>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun étudiant trouvé dans la base de données.
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
                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <th><i class="fas fa-birthday-cake me-1"></i>Date de naissance</th>
                                    <th><i class="fas fa-layer-group me-1"></i>Niveau</th>
                                    <th><i class="fas fa-cog me-1"></i>Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($etudiants as $etudiant_data): ?>
                                <tr class="animated-row">
                                    <?php if ($_SESSION['role'] === 'admin'): ?>
                                        <td><?php echo htmlspecialchars($etudiant_data['id']); ?></td>
                                    <?php endif; ?>
                                    <td class="fw-bold"><?php echo htmlspecialchars($etudiant_data['nom']); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant_data['prenom']); ?></td>
                                    <td>
                                        <a href="mailto:<?php echo htmlspecialchars($etudiant_data['email']); ?>" class="text-decoration-none">
                                            <i class="fas fa-envelope me-1"></i><?php echo htmlspecialchars($etudiant_data['email']); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <i class="fas fa-phone me-1 text-muted"></i>
                                        <?php echo htmlspecialchars($etudiant_data['telephone'] ?: 'N/A'); ?>
                                    </td>
                                    <?php if ($_SESSION['role'] === 'admin'): ?>
                                        <td>
                                            <?php 
                                            if ($etudiant_data['date_naissance']) {
                                                echo '<i class="fas fa-calendar me-1 text-muted"></i>' . date('d/m/Y', strtotime($etudiant_data['date_naissance']));
                                            } else {
                                                echo 'N/A';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <span class="badge-modern badge-niveau">
                                                <?php echo htmlspecialchars($etudiant_data['niveau']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="form.php?id=<?php echo $etudiant_data['id']; ?>" 
                                                   class="btn btn-sm btn-warning-modern" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="../../Gestion_Actions/Etudiant.php?action=delete&id=<?php echo $etudiant_data['id']; ?>" 
                                                   class="btn btn-sm btn-danger-modern" 
                                                   title="Supprimer"
                                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">
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
                
                <?php if ($_SESSION['role'] === 'professeur'): ?>
                    <div class="alert alert-info border-0 shadow-sm mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Mode Consultation Professeur:</strong> Vous voyez uniquement les informations de contact des étudiants (nom, prénom, email, téléphone).
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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

.badge-modern {
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 500;
}

.badge-niveau {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    text-transform: uppercase;
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
