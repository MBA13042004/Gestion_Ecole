-- Insertion d'utilisateurs de test
INSERT INTO utilisateurs (username, password, role) VALUES 
('admin', MD5('admin123'), 'admin'),
('prof1', MD5('prof123'), 'professeur'),
('etudiant1', MD5('etudiant123'), 'etudiant');

-- Insertion de données de test pour les professeurs
INSERT INTO professeurs (nom, prenom, email, telephone, specialite, date_embauche) VALUES 
('Dupont', 'Jean', 'jean.dupont@ecole.fr', '0123456789', 'Mathématiques', '2020-09-01'),
('Martin', 'Marie', 'marie.martin@ecole.fr', '0123456790', 'Français', '2019-09-01'),
('Durand', 'Pierre', 'pierre.durand@ecole.fr', '0123456791', 'Histoire', '2021-09-01');

-- Insertion de données de test pour les étudiants
INSERT INTO etudiants (nom, prenom, email, telephone, date_naissance, niveau) VALUES 
('Alami', 'Ahmed', 'ahmed.alami@student.ecole.fr', '0123456792', '2000-05-15', 'L3'),
('Ouhabi', 'Fatima', 'fatima.ouhabi@student.ecole.fr', '0123456793', '2001-03-20', 'L2'),
('Slimani', 'Youssef', 'youssef.slimani@student.ecole.fr', '0123456794', '1999-12-10', 'M1');
