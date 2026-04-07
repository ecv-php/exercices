<?php
// src/Repository/MovieRepository.php
declare(strict_types=1);

namespace App\Repository;

class MovieRepository
{
    public function __construct(private \PDO $pdo) {}

    public function findAll(): array
    {
        $sql = 'SELECT m.*, d.name AS director_name FROM movies m
                JOIN directors d ON m.director_id = d.id
                ORDER BY m.release_year DESC';
        return $this->pdo->query($sql)->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM movies WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function save(array $data): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO movies (title, release_year, genre, director_id)
             VALUES (:title, :release_year, :genre, :director_id)'
        );
        $stmt->execute($data);
        return (int) $this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE movies SET title = :title, release_year = :release_year,
             genre = :genre, director_id = :director_id WHERE id = :id'
        );
        $stmt->execute([...$data, 'id' => $id]);
    }

    public function delete(int $id): void
    {
        $this->pdo->prepare('DELETE FROM movies WHERE id = :id')
                  ->execute(['id' => $id]);
    }

    public function findDirectors(): array
    {
        return $this->pdo->query('SELECT * FROM directors ORDER BY name')->fetchAll();
    }
}
