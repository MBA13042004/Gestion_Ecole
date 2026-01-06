# 🐳 Gestion École - Docker

## 📋 Prérequis

- Docker Engine 20.10+
- Docker Compose 2.0+
- 2 GB RAM minimum
- Ports disponibles: 8080 (Web), 3307 (MySQL), 8081 (phpMyAdmin)

## 🚀 Démarrage Rapide Ndaaa

### 1. Cloner le projet
```bash
git clone <votre-repo>
cd Gestion_ecole
```

### 2. Démarrer l'application
```bash
# Construire et démarrer tous les services
docker-compose up -d

# Voir les logs
docker-compose logs -f
```

### 3. Accéder à l'application
- **Application**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
  - Serveur: `db`
  - Utilisateur: `root`
  - Mot de passe: `root_password`

## 📦 Services Disponibles

| Service | Port | Description |
|---------|------|-------------|
| **web** | 8080 | Application PHP/Apache |
| **db** | 3307 | Base de données MySQL 8.0 |
| **phpmyadmin** | 8081 | Interface de gestion MySQL |

## 🔧 Commandes Utiles

### Gestion des conteneurs
```bash
# Démarrer les services
docker-compose up -d

# Arrêter les services
docker-compose down

# Arrêter et supprimer les volumes
docker-compose down -v

# Redémarrer un service spécifique
docker-compose restart web

# Voir les logs d'un service
docker-compose logs -f web
```

### Accès aux conteneurs
```bash
# Accéder au conteneur web
docker-compose exec web bash

# Accéder au conteneur MySQL
docker-compose exec db mysql -u root -proot_password gestion_ecole
```

### Gestion de la base de données
```bash
# Importer un fichier SQL
docker-compose exec -T db mysql -u root -proot_password gestion_ecole < fichier.sql

# Exporter la base de données
docker-compose exec db mysqldump -u root -proot_password gestion_ecole > backup.sql

# Réinitialiser la base de données
docker-compose down -v
docker-compose up -d
```

## 🔄 Rebuild et Mise à jour

```bash
# Reconstruire l'image après modifications du Dockerfile
docker-compose build --no-cache

# Reconstruire et redémarrer
docker-compose up -d --build
```

## 🧪 Tests et Développement

```bash
# Mode développement avec logs visibles
docker-compose up

# Vérifier la santé des conteneurs
docker-compose ps

# Vérifier les ressources utilisées
docker stats
```

## 📊 CI/CD avec GitHub Actions

Le projet inclut un workflow GitHub Actions qui:
1. ✅ Valide la syntaxe PHP
2. 🏗️ Build l'image Docker
3. 🧪 Teste le déploiement avec docker-compose
4. 🚀 Déploie automatiquement (si configuré)

### Configuration requise:
- Activer GitHub Actions dans votre repository
- Les secrets suivants sont gérés automatiquement:
  - `GITHUB_TOKEN` (fourni par GitHub)

## 🔐 Variables d'Environnement

Les variables sont définies dans `docker-compose.yml`:

```yaml
DB_HOST=db
DB_PORT=3306
DB_DATABASE=gestion_ecole
DB_USERNAME=ecole_user
DB_PASSWORD=ecole_password
```

Pour la production, créez un fichier `.env`:
```bash
cp .env.example .env
# Éditez .env avec vos valeurs
```

## 🛠️ Dépannage

### Le conteneur web ne démarre pas
```bash
# Vérifier les logs
docker-compose logs web

# Vérifier les permissions
docker-compose exec web ls -la /var/www/html
```

### Impossible de se connecter à MySQL
```bash
# Vérifier que MySQL est démarré
docker-compose ps db

# Vérifier les logs MySQL
docker-compose logs db

# Tester la connexion
docker-compose exec db mysql -u root -proot_password -e "SHOW DATABASES;"
```

### Port déjà utilisé
```bash
# Modifier les ports dans docker-compose.yml
# Exemple: changer 8080:80 en 9000:80
```

## 📝 Notes Importantes

- **Données persistantes**: Les données MySQL sont sauvegardées dans un volume Docker nommé `mysql_data`
- **Développement**: Les fichiers sources sont montés en volume pour le hot-reload
- **Production**: Utilisez des secrets sécurisés et désactivez phpMyAdmin

## 🤝 Support

Pour toute question ou problème:
1. Vérifiez les logs: `docker-compose logs`
2. Consultez la documentation Docker
3. Ouvrez une issue sur GitHub

---

Made with ❤️ pour Gestion École
