CREATE database exam;
use exam;

CREATE TABLE emprunt_membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    genre VARCHAR(1) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    ville VARCHAR(100) NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    image_profil VARCHAR(255)
);

CREATE TABLE emprunt_categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL
);

CREATE TABLE emprunt_objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100) NOT NULL,
    id_categorie INT NOT NULL,
    id_membre INT NOT NULL,
    FOREIGN KEY (id_categorie) REFERENCES emprunt_categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES emprunt_membre(id_membre)
);

CREATE TABLE emprunt_images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    nom_image VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_objet) REFERENCES emprunt_objet(id_objet)
);

CREATE TABLE emprunt_emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    id_membre INT NOT NULL,
    date_emprunt DATE NOT NULL,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES emprunt_objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES emprunt_membre(id_membre)
);


INSERT INTO emprunt_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice Martin', '1990-05-12', 'F', 'alice@mail.com', 'Paris', 'mdp1', 'alice.jpg'),
('Bob Dupont', '1985-09-23', 'H', 'bob@mail.com', 'Lyon', 'mdp2', 'bob.jpg'),
('Claire Dubois', '1992-11-03', 'F', 'claire@mail.com', 'Marseille', 'mdp3', 'claire.jpg'),
('David Leroy', '1988-02-17', 'H', 'david@mail.com', 'Toulouse', 'mdp4', 'david.jpg');

INSERT INTO emprunt_categorie_objet (nom_categorie) VALUES
('esthétique'),
('bricolage'),
('mécanique'),
('cuisine');

INSERT INTO emprunt_objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1),
('Lisseur', 1, 1),
('Perceuse', 2, 1),
('Tournevis', 2, 1),
('Clé à molette', 3, 1),
('Mixeur', 4, 1),
('Batteur', 4, 1),
('Pinceau maquillage', 1, 1),
('Scie', 2, 1),
('Casserole', 4, 1),

('Tondeuse', 1, 2),
('Marteau', 2, 2),
('Tournevis plat', 2, 2),
('Clé dynamométrique', 3, 2),
('Robot pâtissier', 4, 2),
('Fouet', 4, 2),
('Brosse à cheveux', 1, 2),
('Perceuse-visseuse', 2, 2),
('Cafetière', 4, 2),
('Pince multiprise', 3, 2),

('Fer à lisser', 1, 3),
('Scie sauteuse', 2, 3),
('Clé plate', 3, 3),
('Blender', 4, 3),
('Batteur électrique', 4, 3),
('Brosse visage', 1, 3),
('Perceuse à percussion', 2, 3),
('Casserole inox', 4, 3),
('Pince à épiler', 1, 3),
('Tournevis cruciforme', 2, 3),

('Sèche-mains', 1, 4),
('Scie circulaire', 2, 4),
('Clé Allen', 3, 4),
('Robot cuisine', 4, 4),
('Batteur main', 4, 4),
('Brosse barbe', 1, 4),
('Perceuse sans fil', 2, 4),
('Cocotte', 4, 4),
('Pince coupante', 3, 4),
('Tournevis étoile', 2, 4);

INSERT INTO emprunt_images_objet (id_objet, nom_image) VALUES
(1, 'Sèche-cheveux.jpg'),
(2, 'Lisseur.jpeg'),
(3, 'Perceuse.jpeg'),
(4, 'Tournevis.jpg'),
(5, 'clé à molette.jpeg'),
(6, 'Mixeur.jpg'),
(7, 'batteur.jpeg'),
(8, 'Pinceau maquillage.jpg'),
(9, 'Scie.jpg'),
(10, 'casserole.jpeg'),

(11, 'Tondeuse.jpg'),
(12, 'marteau.jpeg'),
(13, 'Tournevis plat.jpg'),
(14, 'clé dynamométrique.jpeg'),
(15, 'Robot pâtissier.jpg'),
(16, 'fouet.jpeg'),
(17, 'brosse à cheveux.jpeg'),
(18, 'perceuse-visseuse.jpeg'),
(19, 'cafetière.jpeg'),
(20, 'Pince multiprise.jpg'),

(21, 'fer à lisser.jpeg'),
(22, 'scie sauteuse.jpg'),
(23, 'clé plate.jpeg'),
(24, 'Blender.jpeg'),
(25, 'batteur éléctrique.jpeg'),
(26, 'brosse visage.jpeg'),
(27, 'perceuse à percussion.jpeg'),
(28, 'casserole inox.jpeg'),
(29, 'Pince à épiler.jpg'),
(30, 'Tournevis cruciforme.jpg'),

(31, 'Sèche-mains.jpg'),
(32, 'scie circulaire.jpg'),
(33, 'clé allen.jpg'),
(34, 'Robot cuisine.jpg'),
(35, 'batteur main.jpeg'),
(36, 'brosse barbe.jpg'),
(37, 'perceuse sans fil.jpg'),
(38, 'cocotte.jpg'),
(39, 'Pince coupante.jpg'),
(40, 'Tournevis étoile.jpg');

INSERT INTO emprunt_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-07-01', '2025-07-05'),
(2, 3, '2025-07-02', NULL),
(3, 4, '2025-07-03', '2025-07-10'),
(4, 1, '2025-07-04', NULL),
(11, 1, '2025-07-05', '2025-07-08'),
(12, 3, '2025-07-06', NULL),
(21, 4, '2025-07-07', '2025-07-12'),
(22, 2, '2025-07-08', NULL),
(31, 3, '2025-07-09', '2025-07-15'),
(32, 1, '2025-07-10', NULL);

CREATE VIEW vue_objets_a_rendre AS
SELECT 
    o.id_objet,
    o.nom_objet,
    c.nom_categorie,
    e.date_emprunt,
    e.date_retour,
    m.nom AS nom_emprunteur
FROM emprunt_objet o
JOIN emprunt_categorie_objet c ON o.id_categorie = c.id_categorie
JOIN emprunt_emprunt e ON o.id_objet = e.id_objet
JOIN emprunt_membre m ON e.id_membre = m.id_membre
WHERE e.date_retour IS NULL;