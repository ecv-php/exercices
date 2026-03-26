<?php
// Exercice 10 Bonus : Filtrage dynamique via paramètres URL
// ?director_id=1 | ?genre=sci-fi | ?year=2021
declare(strict_types=1);
require_once __DIR__ . '/config/database.php';

$pdo = getConnection();

$sql = 'SELECT m.*, d.name AS director_name
        FROM movies m JOIN directors d ON m.director_id = d.id
        WHERE 1=1';
$params = [];

if (!empty($_GET['director_id'])) {
    $sql .= ' AND m.director_id = :director_id';
    $params['director_id'] = (int) $_GET['director_id'];
}
if (!empty($_GET['genre'])) {
    $sql .= ' AND m.genre = :genre';
    $params['genre'] = $_GET['genre'];
}
if (!empty($_GET['year'])) {
    $sql .= ' AND m.release_year = :year';
    $params['year'] = (int) $_GET['year'];
}

$stmt = $pdo->prepare($sql . ' ORDER BY m.release_year DESC');
$stmt->execute($params);
$movies = $stmt->fetchAll();

// Récupérer les réalisateurs pour le filtre
$directors = $pdo->query('SELECT * FROM directors ORDER BY name')->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue SF — Filtres</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 800px; margin: 2rem auto; padding: 0 1rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 0.5rem; border: 1px solid #ddd; text-align: left; }
        th { background: #f5f5f5; }
        tr:hover { background: #fafafa; }
        .filters { display: flex; gap: 1rem; align-items: end; }
        .filters label { display: block; font-size: 0.875rem; margin-bottom: 0.25rem; }
        .filters select, .filters input { padding: 0.4rem; }
    </style>
</head>
<body>
    <h1>Catalogue SF (<?= count($movies) ?> films)</h1>

    <form method="GET" class="filters">
        <div>
            <label for="director_id">Réalisateur</label>
            <select name="director_id" id="director_id">
                <option value="">Tous</option>
                <?php foreach ($directors as $d): ?>
                    <option value="<?= $d['id'] ?>"
                        <?= ($_GET['director_id'] ?? '') == $d['id'] ? 'selected' : '' ?>>
                        <?= $d['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="year">Année</label>
            <input type="number" name="year" id="year"
                   value="<?= $_GET['year'] ?? '' ?>" placeholder="ex: 2021">
        </div>
        <button type="submit">Filtrer</button>
        <a href="movies-filter.php">Reset</a>
    </form>

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
