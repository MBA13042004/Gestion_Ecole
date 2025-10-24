<?php
session_start();
require_once '../../Acces_BD/Etudiant.php';

$page_title = "Liste des Étudiants";
include('../public/header.php');
include('../public/nav_barre.php');

// Vérifier la connexion
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ../../index.php');
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
                <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'professeur'): ?>
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
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Date de naissance</th>
                                <th>Niveau</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($etudiants as $etudiant_data): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($etudiant_data['id']); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant_data['nom']); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant_data['prenom']); ?></td>
                                    <td>
                                        <a href="mailto:<?php echo htmlspecialchars($etudiant_data['email']); ?>">
                                            <?php echo htmlspecialchars($etudiant_data['email']); ?>
                                        </a>
                                    </td>
                                    <td><?php echo htmlspecialchars($etudiant_data['telephone']); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($etudiant_data['date_naissance'])); ?></td>
                                    <td>
                                        <span class="badge bg-info">
                                            <?php echo htmlspecialchars($etudiant_data['niveau']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="form.php?id=<?php echo $etudiant_data['id']; ?>" 
                                               class="btn btn-sm btn-warning" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'professeur'): ?>
                                                <a href="../../Gestion_Actions/Etudiant.php?action=delete&id=<?php echo $etudiant_data['id']; ?>" 
                                                   class="btn btn-sm btn-danger" 
                                                   title="Supprimer"
                                                   onclick="return confirmDelete('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('../public/footer.php'); ?>