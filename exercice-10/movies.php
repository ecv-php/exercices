<?php
// Exercice 10 : Affichage des films avec PDO
declare(strict_types=1);
require_once __DIR__ . '/config/database.php';

$pdo = getConnection();
$sql = 'SELECT m.*, d.name AS director_name FROM movies AS m
        JOIN directors AS d ON m.director_id = d.id
        ORDER BY m.release_year DESC';




$movies = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue de films SF</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 800px; margin: 2rem auto; padding: 0 1rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.5rem; border: 1px solid #ddd; text-align: left; }
        th { background: #f5f5f5; }
        tr:hover { background: #fafafa; }
    </style>
</head>
<body>
    <h1>Catalogue SF (<?= count($movies) ?> films)</h1>
    <table>
        <tr><th>Titre</th><th>Réalisateur</th><th>Année</th><th>Genre</th></tr>
        <?php foreach ($movies as $movie): ?>
            <tr>
                <td><?= $movie['title'] ?></td>
                <td><?= $movie['director_name'] ?></td>
                <td><?= $movie['release_year'] ?></td>
                <td><?= $movie['genre'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
