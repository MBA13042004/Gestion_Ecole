<?php
require_once '../../Acces_BD/session_config.php';
require_once '../../Acces_BD/Etudiant.php';

$page_title = "Formulaire Étudiant";
include('../public/header.php');
include('../public/nav_barre.php');

// Vérifier la connexion et les permissions
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ../../index.php');
    exit();
}

// Seuls les administrateurs peuvent gérer les étudiants
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = 'Seuls les administrateurs peuvent gérer les étudiants.';
    header('Location: ../accueil.php');
    exit();
}

$etudiant = new Etudiant();
$etudiant_data = null;
$is_edit = false;

// Si un ID est fourni, récupérer les données de l'étudiant
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $etudiant_data = $etudiant->afficherParId($_GET['id']);
    if ($etudiant_data) {
        $is_edit = true;
    }
}
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">
                        <i class="fas fa-user-graduate me-2"></i>
                        <?php echo $is_edit ? 'Modifier l\'étudiant' : 'Ajouter un nouvel étudiant'; ?>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="../../Gestion_Actions/Etudiant.php" method="POST">
                        <?php if ($is_edit): ?>
                            <input type="hidden" name="id" value="<?php echo $etudiant_data['id']; ?>">
                        <?php endif; ?>
                        <input type="hidden" name="action" value="<?php echo $is_edit ? 'update' : 'create'; ?>">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom *</label>
                                    <input type="text" class="form-control" id="nom" name="nom" 
                                           value="<?php echo $is_edit ? htmlspecialchars($etudiant_data['nom']) : ''; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom *</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" 
                                           value="<?php echo $is_edit ? htmlspecialchars($etudiant_data['prenom']) : ''; ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo $is_edit ? htmlspecialchars($etudiant_data['email']) : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" id="telephone" name="telephone" 
                                           value="<?php echo $is_edit ? htmlspecialchars($etudiant_data['telephone']) : ''; ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_naissance" class="form-label">Date de naissance</label>
                                    <input type="date" class="form-control" id="date_naissance" name="date_naissance" 
                                           value="<?php echo $is_edit ? $etudiant_data['date_naissance'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="niveau" class="form-label">Niveau</label>
                                    <select class="form-select" id="niveau" name="niveau">
                                        <option value="">Sélectionner un niveau</option>
                                        <option value="L1" <?php echo ($is_edit && $etudiant_data['niveau'] === 'L1') ? 'selected' : ''; ?>>L1</option>
                                        <option value="L2" <?php echo ($is_edit && $etudiant_data['niveau'] === 'L2') ? 'selected' : ''; ?>>L2</option>
                                        <option value="L3" <?php echo ($is_edit && $etudiant_data['niveau'] === 'L3') ? 'selected' : ''; ?>>L3</option>
                                        <option value="M1" <?php echo ($is_edit && $etudiant_data['niveau'] === 'M1') ? 'selected' : ''; ?>>M1</option>
                                        <option value="M2" <?php echo ($is_edit && $etudiant_data['niveau'] === 'M2') ? 'selected' : ''; ?>>M2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="affichage.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                <?php echo $is_edit ? 'Mettre à jour' : 'Créer'; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../public/footer.php'); ?>
