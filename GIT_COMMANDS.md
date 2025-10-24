# Commandes Git pour le Projet Gestion École

## 1. Initialisation du dépôt local

```bash
# Initialiser le dépôt Git
git init

# Configurer l'utilisateur (si pas déjà fait)
git config --global user.name "Votre Nom"
git config --global user.email "votre.email@example.com"

# Ajouter tous les fichiers au staging
git add .

# Premier commit
git commit -m "Initial commit: Création du projet gestion_ecole"
```

## 2. Création du dépôt distant GitHub

```bash
# Créer un nouveau dépôt sur GitHub (via interface web)
# Nom du dépôt: gestion_ecole
# Description: Système de gestion d'école avec PHP et MySQL

# Lier le dépôt local au dépôt distant
git remote add origin https://github.com/VOTRE_USERNAME/gestion_ecole.git

# Vérifier la configuration
git remote -v
```

## 3. Premier push vers GitHub

```bash
# Pousser la branche main vers GitHub
git push -u origin main
```

## 4. Création et gestion des branches

### Création de la branche dev
```bash
# Créer et basculer sur la branche dev
git checkout -b dev

# Ou avec la nouvelle syntaxe
git switch -c dev

# Pousser la branche dev vers GitHub
git push -u origin dev
```

### Ajout d'un fichier sur la branche dev
```bash
# Créer le fichier IHM/accueil.php (déjà créé)
# Ajouter le fichier au staging
git add IHM/accueil.php

# Commit sur la branche dev
git commit -m "feat: Ajout de la page d'accueil avec interface utilisateur"

# Pousser les modifications
git push origin dev
```

## 5. Merge de dev vers main

```bash
# Basculer sur la branche main
git checkout main

# Merger dev dans main
git merge dev

# Pousser les modifications vers GitHub
git push origin main
```

## 6. Simulation de conflits et résolution

### Créer un conflit
```bash
# Sur la branche main, modifier un fichier
# Par exemple, modifier IHM/public/header.php
git add IHM/public/header.php
git commit -m "modify: Modification du header sur main"

# Sur la branche dev, modifier le même fichier
git checkout dev
# Modifier le même fichier différemment
git add IHM/public/header.php
git commit -m "modify: Modification du header sur dev"

# Essayer de merger (conflit attendu)
git checkout main
git merge dev
```

### Résoudre le conflit
```bash
# Éditer le fichier en conflit pour résoudre manuellement
# Ou utiliser un outil de merge
git mergetool

# Après résolution, ajouter le fichier résolu
git add IHM/public/header.php

# Finaliser le merge
git commit -m "resolve: Résolution du conflit dans header.php"

# Pousser les modifications
git push origin main
```

## 7. Création de branches individuelles

### Branche pour Alami
```bash
# Créer la branche branch_alami
git checkout -b branch_alami

# Ajouter des fonctionnalités spécifiques
# Par exemple, améliorer la gestion des étudiants
git add Acces_BD/Etudiant.php
git commit -m "feat: Amélioration de la classe Etudiant par Alami"

# Pousser la branche
git push -u origin branch_alami
```

### Branche pour Ouhabi
```bash
# Créer la branche branch_ouhabi
git checkout -b branch_ouhabi

# Ajouter des fonctionnalités spécifiques
# Par exemple, améliorer la gestion des professeurs
git add Acces_BD/Professeur.php
git commit -m "feat: Amélioration de la classe Professeur par Ouhabi"

# Pousser la branche
git push -u origin branch_ouhabi
```

### Branche pour Slimani
```bash
# Créer la branche branch_slimani
git checkout -b branch_slimani

# Ajouter des fonctionnalités spécifiques
# Par exemple, améliorer l'authentification
git add Acces_BD/Login.php
git commit -m "feat: Amélioration du système d'authentification par Slimani"

# Pousser la branche
git push -u origin branch_slimani
```

## 8. Fusion des branches individuelles vers dev

### Fusion de branch_alami
```bash
# Basculer sur dev
git checkout dev

# Merger branch_alami
git merge branch_alami

# Résoudre les conflits si nécessaire
# Pousser les modifications
git push origin dev
```

### Fusion de branch_ouhabi
```bash
# Merger branch_ouhabi
git merge branch_ouhabi

# Résoudre les conflits si nécessaire
# Pousser les modifications
git push origin dev
```

### Fusion de branch_slimani
```bash
# Merger branch_slimani
git merge branch_slimani

# Résoudre les conflits si nécessaire
# Pousser les modifications
git push origin dev
```

## 9. Fusion finale de dev vers main

```bash
# Basculer sur main
git checkout main

# Merger dev dans main
git merge dev

# Pousser vers GitHub
git push origin main
```

## 10. Commandes utiles pour la gestion

### Voir l'historique des commits
```bash
# Historique simple
git log --oneline

# Historique détaillé
git log --graph --pretty=format:'%h -%d %s (%cr) <%an>' --abbrev-commit

# Historique d'une branche spécifique
git log --oneline dev
```

### Voir les branches
```bash
# Branches locales
git branch

# Branches distantes
git branch -r

# Toutes les branches
git branch -a
```

### Gestion des branches
```bash
# Supprimer une branche locale
git branch -d branch_name

# Supprimer une branche distante
git push origin --delete branch_name

# Renommer une branche
git branch -m old_name new_name
```

### Récupérer les modifications
```bash
# Récupérer les modifications du dépôt distant
git fetch origin

# Merger les modifications
git merge origin/main

# Ou utiliser pull (fetch + merge)
git pull origin main
```

### Annuler des modifications
```bash
# Annuler les modifications non commitées
git checkout -- filename

# Annuler le dernier commit (garder les modifications)
git reset --soft HEAD~1

# Annuler le dernier commit (supprimer les modifications)
git reset --hard HEAD~1
```

## 11. Workflow recommandé pour l'équipe

1. **Toujours commencer par récupérer les dernières modifications**
   ```bash
   git checkout main
   git pull origin main
   ```

2. **Créer une nouvelle branche pour chaque fonctionnalité**
   ```bash
   git checkout -b feature/nom-fonctionnalite
   ```

3. **Travailler sur la fonctionnalité et commiter régulièrement**
   ```bash
   git add .
   git commit -m "feat: Description de la fonctionnalité"
   ```

4. **Pousser la branche et créer une Pull Request**
   ```bash
   git push -u origin feature/nom-fonctionnalite
   ```

5. **Après validation, merger dans dev puis main**

## 12. Tags pour les versions

```bash
# Créer un tag pour une version
git tag -a v1.0.0 -m "Version 1.0.0 - Première version stable"

# Pousser les tags
git push origin v1.0.0

# Lister les tags
git tag

# Supprimer un tag
git tag -d v1.0.0
git push origin --delete v1.0.0
```

## 13. Sauvegarde et restauration

```bash
# Créer un stash (sauvegarde temporaire)
git stash

# Lister les stashes
git stash list

# Restaurer un stash
git stash pop

# Supprimer un stash
git stash drop
```

## 14. Commandes de diagnostic

```bash
# Voir l'état du dépôt
git status

# Voir les différences
git diff

# Voir les différences d'un fichier spécifique
git diff filename

# Voir les modifications commitées
git diff HEAD~1 HEAD
```

## 15. Configuration avancée

```bash
# Configurer un alias pour des commandes fréquentes
git config --global alias.st status
git config --global alias.co checkout
git config --global alias.br branch
git config --global alias.ci commit

# Utilisation des alias
git st  # équivalent à git status
git co main  # équivalent à git checkout main
```
