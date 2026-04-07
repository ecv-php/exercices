<?php
// src/Controller/MovieController.php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\MovieRepository;

class MovieController
{
    private MovieRepository $repository;

    public function __construct(\PDO $pdo)
    {
        $this->repository = new MovieRepository($pdo);
    }

    public function list(): void
    {
        $movies = $this->repository->findAll();
        require __DIR__ . '/../../views/movies/list.php';
    }

    public function show(int $id): void
    {
        $movie = $this->repository->find($id);
        if (!$movie) {
            http_response_code(404);
            echo 'Film non trouvé';
            return;
        }
        require __DIR__ . '/../../views/movies/show.php';
    }

    public function create(): void
    {
        $directors = $this->repository->findDirectors();
        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = [
                'title' => trim($_POST['title'] ?? ''),
                'release_year' => $_POST['release_year'] ?? '',
                'genre' => trim($_POST['genre'] ?? ''),
                'director_id' => $_POST['director_id'] ?? '',
            ];

            // Validation
            if ($old['title'] === '') $errors['title'] = 'Le titre est requis';
            if ($old['release_year'] === '') $errors['release_year'] = "L'année est requise";
            if ($old['genre'] === '') $errors['genre'] = 'Le genre est requis';
            if ($old['director_id'] === '') $errors['director_id'] = 'Le réalisateur est requis';

            if (empty($errors)) {
                $this->repository->save([
                    'title' => $old['title'],
                    'release_year' => (int) $old['release_year'],
                    'genre' => $old['genre'],
                    'director_id' => (int) $old['director_id'],
                ]);
                header('Location: index.php?page=movies');
                exit;
            }
        }

        require __DIR__ . '/../../views/movies/create.php';
    }

    public function delete(int $id): void
    {
        $movie = $this->repository->find($id);
        if (!$movie) {
            http_response_code(404);
            echo 'Film non trouvé';
            return;
        }

        $this->repository->delete($id);
        header('Location: index.php?page=movies');
        exit;
    }
}
