-- Exercice 8 : Modélisation BDD — Catalogue de films SF
-- Schéma Entity-Relationship : directors (1) → (N) movies

CREATE DATABASE IF NOT EXISTS cinema
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cinema;

CREATE TABLE directors (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nationality VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE movies (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    director_id INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    release_year SMALLINT UNSIGNED,
    genre ENUM('action', 'comedy', 'drama', 'horror', 'sci-fi') DEFAULT 'sci-fi',
    synopsis TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (director_id) REFERENCES directors(id) ON DELETE CASCADE,
    INDEX idx_director (director_id)
) ENGINE=InnoDB;
