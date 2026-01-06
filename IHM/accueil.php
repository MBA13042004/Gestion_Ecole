<?php
require_once '../Acces_BD/session_config.php';
$page_title = "Accueil";
include('public/header.php');
include('public/nav_barre.php');
?>

<div class="hero-section">
    <div class="container">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            
            <!-- Message d'accueil personnalisé -->
            <div class="welcome-card fade-in-up">
                <div class="welcome-header">
                    <div class="avatar-circle">
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <i class="fas fa-user-shield"></i>
                        <?php elseif ($_SESSION['role'] === 'professeur'): ?>
                            <i class="fas fa-chalkboard-teacher"></i>
                        <?php else: ?>
                            <i class="fas fa-user-graduate"></i>
                        <?php endif; ?>
                    </div>
                    <div class="welcome-text">
                        <h1 class="gradient-text">Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?> !</h1>
                        <p class="role-badge">
                            <?php if ($_SESSION['role'] === 'admin'): ?>
                                <span class="badge-role badge-admin">
                                    <i class="fas fa-shield-alt me-2"></i>Administrateur
                                </span>
                            <?php elseif ($_SESSION['role'] === 'professeur'): ?>
                                <span class="badge-role badge-professor">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>Professeur
                                </span>
                            <?php else: ?>
                                <span class="badge-role badge-student">
                                    <i class="fas fa-graduation-cap me-2"></i>Étudiant
                                </span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-info alert-dismissible fade show modern-alert" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <?php 
                    echo htmlspecialchars($_SESSION['message']); 
                    unset($_SESSION['message']);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Cartes d'Action Personnalisées -->
            <div class="row g-4 mt-4">
                
                <?php if ($_SESSION['role'] === 'etudiant'): ?>
                    <!-- Vue Étudiant -->
                    <div class="col-md-6">
                        <div class="action-card student-card">
                            <div class="card-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <h3>Mon Profil</h3>
                            <p>Consultez vos informations personnelles et académiques</p>
                            <a href="Etudiant/mon_profil.php" class="btn-action btn-student">
                                <span>Voir Mon Profil</span>
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <div class="card-decoration"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="action-card professor-card">
                            <div class="card-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <h3>Mes Professeurs</h3>
                            <p>Consultez les informations de contact de vos professeurs</p>
                            <a href="Prof/affichage.php" class="btn-action btn-professor">
                                <span>Voir Mes Professeurs</span>
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <div class="card-decoration"></div>
                        </div>
                    </div>

                <?php elseif ($_SESSION['role'] === 'professeur'): ?>
                    <!-- Vue Professeur -->
                    <div class="col-md-6">
                        <div class="action-card professor-card">
                            <div class="card-icon">
                                <i class="fas fa-id-badge"></i>
                            </div>
                            <h3>Mon Profil</h3>
                            <p>Consultez vos informations personnelles et professionnelles</p>
                            <a href="Prof/mon_profil.php" class="btn-action btn-professor">
                                <span>Voir Mon Profil</span>
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <div class="card-decoration"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="action-card student-card">
                            <div class="card-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h3>Mes Étudiants</h3>
                            <p>Consultez les informations de contact de vos étudiants</p>
                            <a href="Etudiant/affichage.php" class="btn-action btn-student">
                                <span>Voir Mes Étudiants</span>
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <div class="card-decoration"></div>
                        </div>
                    </div>

                <?php else: ?>
                    <!-- Vue Administrateur -->
                    <div class="col-md-6">
                        <div class="action-card admin-card-students">
                            <div class="card-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h3>Gestion des Étudiants</h3>
                            <p>Ajouter, modifier, supprimer et consulter les étudiants</p>
                            <div class="btn-group-custom">
                                <a href="Etudiant/affichage.php" class="btn-action btn-student">
                                    <i class="fas fa-list me-2"></i>
                                    <span>Liste Complète</span>
                                </a>
                                <a href="Etudiant/form.php" class="btn-action-secondary btn-student-secondary">
                                    <i class="fas fa-plus me-2"></i>
                                    <span>Ajouter</span>
                                </a>
                            </div>
                            <div class="card-decoration"></div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="action-card admin-card-professors">
                            <div class="card-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <h3>Gestion des Professeurs</h3>
                            <p>Ajouter, modifier, supprimer et consulter les professeurs</p>
                            <div class="btn-group-custom">
                                <a href="Prof/affichage.php" class="btn-action btn-professor">
                                    <i class="fas fa-list me-2"></i>
                                    <span>Liste Complète</span>
                                </a>
                                <a href="Prof/form.php" class="btn-action-secondary btn-professor-secondary">
                                    <i class="fas fa-plus me-2"></i>
                                    <span>Ajouter</span>
                                </a>
                            </div>
                            <div class="card-decoration"></div>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="admin-info-banner">
                            <i class="fas fa-crown me-3"></i>
                            <div>
                                <strong>Accès Administrateur</strong>
                                <p class="mb-0">Vous avez un accès complet aux fonctionnalités de gestion</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
            </div>

        <?php else: ?>
            <!-- Vue Non-Connecté -->
            <div class="login-prompt-card">
                <div class="login-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h2>Accès Restreint</h2>
                <p>Veuillez vous connecter pour accéder au système de gestion</p>
                <a href="../Index.php" class="btn-action btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    <span>Se Connecter</span>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
/* Hero Section */
.hero-section {
    min-height: 80vh;
    padding: 3rem 0;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

/* Welcome Card */
.welcome-card {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.welcome-header {
    display: flex;
    align-items: center;
    gap: 2rem;
}

.avatar-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
    box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);
}

.welcome-text h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.badge-role {
    display: inline-flex;
    align-items: center;
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
}

.badge-admin {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.badge-professor {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
}

.badge-student {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
}

/* Action Cards */
.action-card {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    height: 100%;
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.action-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
}

.card-icon {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    z-index: 2;
}

.student-card .card-icon {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
}

.professor-card .card-icon {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
}

.admin-card-students .card-icon,
.admin-card-professors .card-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.action-card h3 {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: #2d3748;
}

.action-card p {
    color: #718096;
    font-size: 1.05rem;
    margin-bottom: 2rem;
    line-height: 1.6;
}

/* Buttons */
.btn-action {
    display: inline-flex;
    align-items: center;
    padding: 14px 32px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1.05rem;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
    border: none;
    color: white;
}

.btn-student {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
}

.btn-student:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 25px rgba(79, 172, 254, 0.5);
    color: white;
}

.btn-professor {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    box-shadow: 0 4px 15px rgba(17, 153, 142, 0.3);
}

.btn-professor:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 25px rgba(17, 153, 142, 0.5);
    color: white;
}

.btn-login {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-login:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 25px rgba(102, 126, 234, 0.5);
    color: white;
}

/* Button Group for Admin */
.btn-group-custom {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-action-secondary {
    display: inline-flex;
    align-items: center;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    background: white;
    border: 2px solid;
}

.btn-student-secondary {
    border-color: #4facfe;
    color: #4facfe;
}

.btn-student-secondary:hover {
    background: #4facfe;
    color: white;
}

.btn-professor-secondary {
    border-color: #11998e;
    color: #11998e;
}

.btn-professor-secondary:hover {
    background: #11998e;
    color: white;
}

/* Card Decoration */
.card-decoration {
    position: absolute;
    bottom: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    opacity: 0.1;
    z-index: 1;
}

.student-card .card-decoration {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.professor-card .card-decoration {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.admin-card-students .card-decoration,
.admin-card-professors .card-decoration {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Admin Info Banner */
.admin-info-banner {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem 2rem;
    border-radius: 16px;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
}

.admin-info-banner i {
    font-size: 2rem;
}

/* Login Prompt Card */
.login-prompt-card {
    background: white;
    border-radius: 24px;
    padding: 4rem 3rem;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    max-width: 500px;
    margin: 4rem auto;
}

.login-icon {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
    margin: 0 auto 2rem;
    box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);
}

.login-prompt-card h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: #2d3748;
}

.login-prompt-card p {
    color: #718096;
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

/* Modern Alert */
.modern-alert {
    border-radius: 16px;
    border: none;
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    padding: 1.25rem 1.5rem;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

/* Responsive */
@media (max-width: 768px) {
    .welcome-header {
        flex-direction: column;
        text-align: center;
    }
    
    .welcome-text h1 {
        font-size: 1.75rem;
    }
    
    .action-card h3 {
        font-size: 1.5rem;
    }
    
    .btn-group-custom {
        flex-direction: column;
    }
    
    .btn-action,
    .btn-action-secondary {
        width: 100%;
        justify-content: center;
    }
}
</style>

<?php include('public/footer.php'); ?>
