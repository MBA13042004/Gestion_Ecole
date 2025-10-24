<?php
$page_title = "Connexion";
include('IHM/public/header.php');
?>

<!-- Page d'accueil principale -->
<div class="container">
    <h1>Bienvenue dans l'application de gestion d'école</h1>
    <p>Cette application vous permet de gérer les informations des étudiants et des professeurs.</p>
    
    <!-- Formulaire d'authentification -->
    <div class="authentification">
        <h2>Formulaire de connexion</h2>
        <form action="Gestion_Actions/login.php" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
</div>

<?php
// Inclure la barre de navigation
include('IHM/public/nav_barre.php');

// Inclure le pied de page
include('IHM/public/footer.php');
?>
