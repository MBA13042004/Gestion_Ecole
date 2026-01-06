-- Script de mise à jour pour lier utilisateurs aux étudiants et professeurs
USE gestion_ecole;

-- Ajouter colonne user_id à la table etudiants si elle n'existe pas
ALTER TABLE etudiants 
ADD COLUMN IF NOT EXISTS user_id INT NULL,
ADD CONSTRAINT fk_etudiant_user FOREIGN KEY (user_id) REFERENCES utilisateurs(id) ON DELETE SET NULL;

-- Ajouter colonne user_id à la table professeurs si elle n'existe pas
ALTER TABLE professeurs 
ADD COLUMN IF NOT EXISTS user_id INT NULL,
ADD CONSTRAINT fk_professeur_user FOREIGN KEY (user_id) REFERENCES utilisateurs(id) ON DELETE SET NULL;

-- Lier l'utilisateur etudiant1 à un étudiant existant (basé sur email ou créer nouveau)
-- Mettre à jour l'étudiant avec l'email correspondant
UPDATE etudiants SET user_id = (SELECT id FROM utilisateurs WHERE username = 'etudiant1') 
WHERE email = 'ahmed.alami@student.ecole.fr';

-- Lier l'utilisateur prof1 à un professeur existant
UPDATE professeurs SET user_id = (SELECT id FROM utilisateurs WHERE username = 'prof1') 
WHERE email = 'jean.dupont@ecole.fr';

-- Afficher les liens créés
SELECT u.username, u.role, e.nom, e.prenom, e.email 
FROM utilisateurs u 
LEFT JOIN etudiants e ON u.id = e.user_id 
WHERE u.role = 'etudiant';

SELECT u.username, u.role, p.nom, p.prenom, p.email 
FROM utilisateurs u 
LEFT JOIN professeurs p ON u.id = p.user_id 
WHERE u.role = 'professeur';
