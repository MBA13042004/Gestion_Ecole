<?php
require_once '../../Acces_BD/session_config.php';
require_once '../../Acces_BD/Professeur.php';

$page_title = "Formulaire Professeur";
include('../public/header.php');
include('../public/nav_barre.php');

// Vérifier la connexion et les permissions
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ../../index.php');
    exit();
}

// Seuls les administrateurs peuvent gérer les professeurs
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['message'] = 'Seuls les administrateurs peuvent gérer les professeurs.';
    header('Location: ../accueil.php');
    exit();
}

$professeur = new Professeur();
$professeur_data = null;
$is_edit = false;

// Si un ID est fourni, récupérer les données du professeur
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $professeur_data = $professeur->afficherParId($_GET['id']);
    if ($professeur_data) {
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
                        <i class="fas fa-chalkboard-teacher me-2"></i>
                        <?php echo $is_edit ? 'Modifier le professeur' : 'Ajouter un nouveau professeur'; ?>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="../../Gestion_Actions/Professeur.php" method="POST">
                        <?php if ($is_edit): ?>
                            <input type="hidden" name="id" value="<?php echo $professeur_data['id']; ?>">
                        <?php endif; ?>
                        <input type="hidden" name="action" value="<?php echo $is_edit ? 'update' : 'create'; ?>">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom *</label>
                                    <input type="text" class="form-control" id="nom" name="nom" 
                                           value="<?php echo $is_edit ? htmlspecialchars($professeur_data['nom']) : ''; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom *</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" 
                                           value="<?php echo $is_edit ? htmlspecialchars($professeur_data['prenom']) : ''; ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo $is_edit ? htmlspecialchars($professeur_data['email']) : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" id="telephone" name="telephone" 
                                           value="<?php echo $is_edit ? htmlspecialchars($professeur_data['telephone']) : ''; ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="specialite" class="form-label">Spécialité</label>
                                    <input type="text" class="form-control" id="specialite" name="specialite" 
                                           value="<?php echo $is_edit ? htmlspecialchars($professeur_data['specialite']) : ''; ?>"
                                           placeholder="Ex: Mathématiques, Français, Histoire...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_embauche" class="form-label">Date d'embauche</label>
                                    <input type="date" class="form-control" id="date_embauche" name="date_embauche" 
                                           value="<?php echo $is_edit ? $professeur_data['date_embauche'] : ''; ?>">
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
