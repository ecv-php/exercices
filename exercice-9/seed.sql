-- Exercice 9 : Création de la BDD et insertion de données de test
-- Exécuter après exercice-8/schema.sql

USE cinema;

INSERT INTO directors (name, nationality) VALUES
('Ridley Scott', 'Britannique'),
('Denis Villeneuve', 'Canadien'),
('Lana Wachowski', 'Américaine');

INSERT INTO movies (director_id, title, release_year, genre) VALUES
(1, 'Alien', 1979, 'sci-fi'),
(1, 'Blade Runner', 1982, 'sci-fi'),
(1, 'The Martian', 2015, 'sci-fi'),
(2, 'Dune', 2021, 'sci-fi'),
(2, 'Dune: Part Two', 2024, 'sci-fi'),
(2, 'Arrival', 2016, 'sci-fi'),
(3, 'The Matrix', 1999, 'sci-fi');
