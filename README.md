# 🎓 Gestion École - Système de Gestion Scolaire

## 📋 Description du Projet

Ce projet est une mini-application PHP simulant la gestion d'une école. Il permet de gérer les informations des étudiants et des professeurs avec une interface web moderne et intuitive.

## 🏗️ Architecture du Projet

```
gestion_ecole/
├── 📄 index.php                    # Page d'accueil et authentification
├── 📁 IHM/                         # Interface Homme-Machine
│   ├── 📄 accueil.php             # Tableau de bord principal
│   ├── 📁 Etudiant/               # Gestion des étudiants
│   │   ├── 📄 form.php            # Formulaire d'ajout/modification
│   │   └── 📄 affichage.php       # Liste des étudiants
│   ├── 📁 Prof/                   # Gestion des professeurs
│   │   ├── 📄 form.php            # Formulaire d'ajout/modification
│   │   └── 📄 affichage.php       # Liste des professeurs
│   └── 📁 public/                 # Ressources partagées
│       ├── 📄 header.php          # En-tête commun
│       ├── 📄 footer.php          # Pied de page commun
│       ├── 📄 nav_barre.php       # Navigation
│       └── 📄 styles.css          # Styles personnalisés
├── 📁 Acces_BD/                   # Accès à la base de données
│   ├── 📄 connexion.php           # Connexion à la base
│   ├── 📄 .env                    # Configuration (à créer)
│   ├── 📄 Login.php               # Gestion de l'authentification
│   ├── 📄 Professeur.php         # Modèle Professeur
│   └── 📄 Etudiant.php            # Modèle Étudiant
└── 📁 Gestion_Actions/           # Contrôleurs
    ├── 📄 login.php               # Traitement de connexion
    ├── 📄 logout.php              # Déconnexion
    ├── 📄 Professeur.php          # Actions sur les professeurs
    └── 📄 Etudiant.php            # Actions sur les étudiants
```

## 🚀 Fonctionnalités

### 🔐 Authentification
- Système de connexion sécurisé
- Gestion des rôles (Admin, Professeur, Étudiant)
- Sessions utilisateur

### 👨‍🎓 Gestion des Étudiants
- ✅ Affichage de la liste des étudiants
- ➕ Ajout de nouveaux étudiants
- ✏️ Modification des informations
- 🗑️ Suppression d'étudiants
- 🔍 Recherche et filtrage

### 👨‍🏫 Gestion des Professeurs
- ✅ Affichage de la liste des professeurs
- ➕ Ajout de nouveaux professeurs
- ✏️ Modification des informations
- 🗑️ Suppression de professeurs
- 🔍 Recherche et filtrage

### 🎨 Interface Utilisateur
- Design responsive avec Bootstrap 5
- Interface moderne et intuitive
- Navigation claire et accessible
- Messages de confirmation et d'erreur

## 🛠️ Technologies Utilisées

- **Backend**: PHP 7.4+
- **Base de données**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, Bootstrap 5
- **Icônes**: Font Awesome 6
- **Contrôle de version**: Git

## 📋 Prérequis

- Serveur web (Apache/Nginx)
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Extension PHP MySQLi

## ⚙️ Installation

### 1. Cloner le projet
```bash
git clone https://github.com/VOTRE_USERNAME/gestion_ecole.git
cd gestion_ecole
```

### 2. Configuration de la base de données
```bash
# Créer la base de données
mysql -u root -p < database_setup.sql
```

### 3. Configuration de l'environnement
```bash
# Créer le fichier .env dans Acces_BD/
cp Acces_BD/env.txt Acces_BD/.env

# Éditer les paramètres de connexion
nano Acces_BD/.env
```

Contenu du fichier `.env` :
```ini
serveur=localhost
utilisateur=root
password=
db_name=gestion_ecole
```

### 4. Configuration du serveur web
- Placer le projet dans le répertoire web de votre serveur
- Configurer les permissions appropriées
- Accéder à l'application via `http://localhost/gestion_ecole`

## 👥 Comptes de Test

| Utilisateur | Mot de passe | Rôle |
|-------------|--------------|------|
| admin | admin123 | Administrateur |
| prof1 | prof123 | Professeur |
| etudiant1 | etudiant123 | Étudiant |

## 🗄️ Structure de la Base de Données

### Table `utilisateurs`
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `username` (VARCHAR(50), UNIQUE)
- `password` (VARCHAR(255), MD5)
- `role` (ENUM: 'admin', 'professeur', 'etudiant')
- `created_at` (TIMESTAMP)

### Table `professeurs`
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `nom` (VARCHAR(100))
- `prenom` (VARCHAR(100))
- `email` (VARCHAR(100), UNIQUE)
- `telephone` (VARCHAR(20))
- `specialite` (VARCHAR(100))
- `date_embauche` (DATE)
- `created_at` (TIMESTAMP)

### Table `etudiants`
- `id` (INT, AUTO_INCREMENT, PRIMARY KEY)
- `nom` (VARCHAR(100))
- `prenom` (VARCHAR(100))
- `email` (VARCHAR(100), UNIQUE)
- `telephone` (VARCHAR(20))
- `date_naissance` (DATE)
- `niveau` (VARCHAR(50))
- `created_at` (TIMESTAMP)

## 🔧 Utilisation

### Connexion
1. Accéder à `http://localhost/gestion_ecole`
2. Utiliser un des comptes de test
3. Naviguer dans l'interface selon votre rôle

### Gestion des Étudiants
1. Aller dans "Étudiants" depuis le menu
2. Utiliser les boutons d'action pour :
   - Ajouter un nouvel étudiant
   - Modifier les informations
   - Supprimer un étudiant

### Gestion des Professeurs
1. Aller dans "Professeurs" depuis le menu
2. Utiliser les boutons d'action pour :
   - Ajouter un nouveau professeur
   - Modifier les informations
   - Supprimer un professeur

## 🧪 Tests

### Test de connexion à la base
```bash
php Acces_BD/test.php
```

### Test des fonctionnalités
1. Tester la connexion avec différents comptes
2. Tester l'ajout d'étudiants et professeurs
3. Tester la modification et suppression
4. Vérifier les permissions selon les rôles

## 📚 Documentation Git

Voir le fichier `GIT_COMMANDS.md` pour toutes les commandes Git nécessaires au développement collaboratif.

## 🤝 Contribution

1. Fork le projet
2. Créer une branche pour votre fonctionnalité (`git checkout -b feature/nouvelle-fonctionnalite`)
3. Commiter vos changements (`git commit -m 'Ajout d'une nouvelle fonctionnalité'`)
4. Pousser vers la branche (`git push origin feature/nouvelle-fonctionnalite`)
5. Ouvrir une Pull Request

## 📝 Changelog

### Version 1.0.0
- ✅ Système d'authentification complet
- ✅ Gestion CRUD des étudiants
- ✅ Gestion CRUD des professeurs
- ✅ Interface utilisateur moderne
- ✅ Gestion des rôles et permissions
- ✅ Design responsive

## 🐛 Problèmes Connus

- Aucun problème connu à ce jour

## 📞 Support

Pour toute question ou problème :
- Créer une issue sur GitHub
- Contacter l'équipe de développement

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👥 Équipe

- **Alami** - Développement backend
- **Ouhabi** - Interface utilisateur
- **Slimani** - Base de données et sécurité

---

**Développé avec ❤️ pour l'apprentissage du DevOps et du développement web**
