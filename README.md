# 🎓 Gestion École

Application web de gestion scolaire développée en PHP/MySQL avec une interface moderne et responsive.

![PHP](https://img.shields.io/badge/PHP-8.1-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.1-7952B3?logo=bootstrap&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?logo=docker&logoColor=white)

## ✨ Fonctionnalités Ndaaaaaaaaaaaaaaaaaaaaaaaaaaaa

### 🔐 Système d'Authentification
- **3 rôles** : Administrateur, Professeur, Étudiant
- Interface de connexion ultra-moderne avec animations
- Sessions sécurisées

### 👥 Gestion par Rôle hhhhh

#### Administrateur
- ✅ CRUD complet des étudiants
- ✅ CRUD complet des professeurs
- ✅ Accès à toutes les fonctionnalités
- ✅ Dashboard avec statistiques

#### Professeur
- 👁️ Vue personnelle de son profil
- 👁️ Consultation des étudiants (nom, prénom, email, téléphone uniquement)
- ❌ Pas de modification des données

#### Étudiant
- 👁️ Vue personnelle de son profil complet
- 👁️ Consultation des professeurs (nom, prénom, email, téléphone, spécialité)
- ❌ Pas d'accès aux autres étudiants

### 🎨 Interface Utilisateur Moderne
- **Design ultra-attractif** avec gradients et glassmorphism
- **Animations fluides** sur tous les éléments
- **Page d'accueil personnalisée** selon le rôle
- **Navigation intuitive** et responsive
- **Thème moderne** avec Inter font

## 🚀 Démarrage Rapide

### Option 1: Avec Docker (Recommandé)

```bash
# 1. Cloner le projet
git clone <votre-repo>
cd Gestion_ecole

# 2. Démarrer avec Docker Compose
docker-compose up -d

# 3. Accéder à l'application
# Application: http://localhost:8080
# phpMyAdmin: http://localhost:8081
```

📖 **Documentation complète**: Voir [DOCKER.md](DOCKER.md)

### Option 2: Installation Manuelle (XAMPP)

#### Prérequis
- PHP 7.4+
- MySQL 5.7+
- Apache 2.4+
- Extensions PHP: mysqli, pdo_mysql, mbstring

#### Installation

```bash
# 1. Cloner dans htdocs
cd C:\xampp\htdocs
git clone <votre-repo> Gestion_ecole

# 2. Importer la base de données
# Dans phpMyAdmin, créer la base 'gestion_ecole'
# Importer database_setup.sql
# Puis importer database_update_userlinks.sql

# 3. Démarrer Apache et MySQL
# Via le panneau de contrôle XAMPP

# 4. Accéder à l'application
# http://localhost/Gestion_ecole
```

## 🔑 Comptes de Démonstration

| Rôle | Username | Mot de passe |
|------|----------|--------------|
| 👨‍💼 Admin | `admin` | `admin123` |
| 👨‍🏫 Professeur | `prof1` | `prof123` |
| 👨‍🎓 Étudiant | `etudiant1` | `etudiant123` |

## 📁 Structure du Projet

```
Gestion_ecole/
├── 📂 Acces_BD/              # Classes d'accès aux données
│   ├── Etudiant.php
│   ├── Professeur.php
│   ├── Login.php
│   └── session_config.php
├── 📂 Gestion_Actions/       # Contrôleurs
│   ├── Etudiant.php
│   ├── Professeur.php
│   └── login.php
├── 📂 IHM/                   # Interface utilisateur
│   ├── 📂 Etudiant/          # Vues étudiants
│   │   ├── affichage.php
│   │   ├── form.php
│   │   └── mon_profil.php
│   ├── 📂 Prof/              # Vues professeurs
│   │   ├── affichage.php
│   │   ├── form.php
│   │   └── mon_profil.php
│   ├── 📂 public/            # Composants partagés
│   │   ├── header.php
│   │   ├── nav_barre.php
│   │   ├── footer.php
│   │   └── styles.css
│   └── accueil.php           # Page d'accueil
├── 📂 docker/                # Configuration Docker
│   ├── 📂 apache/
│   └── 📂 php/
├── 📄 Index.php              # Page de connexion
├── 📄 database_setup.sql     # Structure BDD
├── 📄 Dockerfile             # Image Docker
├── 📄 docker-compose.yml     # Orchestration
└── 📄 .github/workflows/     # CI/CD
    └── ci-cd.yml
```

## 🔧 Technologies Utilisées

- **Backend**: PHP 8.1
- **Base de données**: MySQL 8.0
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework CSS**: Bootstrap 5.1
- **Icônes**: Font Awesome 6
- **Font**: Google Fonts (Inter)
- **Conteneurisation**: Docker & Docker Compose
- **CI/CD**: GitHub Actions

## 🐳 Docker

Le projet est entièrement dockerisé avec:
- **Web**: PHP 8.1 + Apache
- **Database**: MySQL 8.0
- **phpMyAdmin**: Interface de gestion MySQL

Commandes utiles:
```bash
# Démarrer
docker-compose up -d

# Voir les logs
docker-compose logs -f

# Arrêter
docker-compose down

# Rebuild
docker-compose up -d --build
```

## 🔄 CI/CD

GitHub Actions configuré pour:
- ✅ Tests de syntaxe PHP
- ✅ Validation de la structure du projet
- 🏗️ Build automatique de l'image Docker
- 🧪 Tests d'intégration
- 🚀 Déploiement automatique (configurable)

## 🛡️ Sécurité

- ✅ Sessions sécurisées avec `session_config.php`
- ✅ Requêtes préparées (protection injection SQL)
- ✅ Validation des rôles à chaque action
- ✅ Headers de sécurité configurés
- ⚠️ **À améliorer**: Migrer de MD5 vers `password_hash()`

## 📊 Base de Données

### Tables Principales
- `utilisateurs` - Gestion des comptes
- `etudiants` - Informations étudiants
- `professeurs` - Informations professeurs

### Scripts SQL
1. `database_setup.sql` - Structure et données de base
2. `database_update_userlinks.sql` - Liens user_id (optionnel)

## 🎨 Interface

### Page de Connexion
- Background animé avec gradients
- Carte glassmorphism
- Toggle mot de passe
- Remplissage auto des identifiants

### Dashboard
- Personnalisé selon le rôle
- Cartes d'action avec animations
- Design ultra-moderne
- Responsive mobile

### Pages de Profil
- Vue personnalisée pour chaque utilisateur
- Design avec gradient headers
- Informations organisées en sections
- Mode lecture seule pour non-admins

## 📝 Développement

### Ajouter une nouvelle fonctionnalité

1. **Backend**: Créer la classe dans `Acces_BD/`
2. **Contrôleur**: Ajouter la logique dans `Gestion_Actions/`
3. **Vue**: Créer l'interface dans `IHM/`
4. **RBAC**: Vérifier les permissions par rôle

### Conventions de code
- PSR-2 pour PHP
- Noms de fichiers en PascalCase pour les classes
- Commentaires en français
- Indentation: 4 espaces

## 🐛 Dépannage

### Erreur de connexion MySQL
```bash
# Vérifier la configuration dans Acces_BD/.env
# Ou dans docker-compose.yml si Docker
```

### Session non démarrée
```bash
# Vérifier que session_config.php est inclus
# en premier dans chaque fichier
```

### Permissions Docker
```bash
# Rebuilder avec les bonnes permissions
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

## 📚 Documentation Complète

- [📖 Guide Docker](DOCKER.md)
- [✅ Guide de Tests](guide_test.md)
- [🔧 Fix Profils](fix_profil.md)
- [📝 Walkthrough](walkthrough.md)

## 🤝 Contribution

Les contributions sont les bienvenues ! Merci de:
1. Fork le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📄 Licence

Ce projet est sous licence MIT.

## 👨‍💻 Auteur

Développé avec ❤️ pour la gestion scolaire moderne

---

**Note**: Ce projet est un système de démonstration. Pour une utilisation en production, implémentez des mesures de sécurité supplémentaires (HTTPS, hachage bcrypt, CSRF protection, etc.).
#   G e s t i o n _ E c o l e 
 
 #   G e s t i o n _ E c o l e 
 
 