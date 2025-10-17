# Gestion_ecole
gestion_ecole/
│
├── IHM/                   # Interface Homme-Machine (partie affichage)
│   ├── accueil.php        # Page d'accueil ou tableau de bord
│   ├── Prof/              # Sous-dossier pour les professeurs
│   │   ├── form.php       # Formulaire d'ajout/modification des professeurs
│   │   └── affichage.php  # Affichage des détails sur un professeur
│   └── Etudiant/          # Sous-dossier pour les étudiants
│       ├── form.php       # Formulaire d'ajout/modification des étudiants
│       └── affichage.php  # Affichage des détails sur un étudiant
│
├── Acces_BD/              # Gestion de la connexion à la base de données
│   ├── .env               # Paramètres de connexion MySQL
│   ├── connexion.php      # Fichier pour établir la connexion à la base de données
│   ├── Login.php          # Fonction login() et logout()
│   ├── Professeur.php     # Fonctions de gestion des professeurs
│   └── Etudiant.php       # Fonctions de gestion des étudiants
│
└── public/                # Dossier public (fichiers communs)
    ├── header.php         # En-tête commun à toutes les pages
    ├── footer.php         # Pied de page commun à toutes les pages
    ├── nav_barre.php      # Barre de navigation
    ├── styles.css         # Fichier CSS pour le style global du site
    └── images/            # Dossier pour les images du site
