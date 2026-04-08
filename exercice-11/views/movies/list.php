<?php
// views/movies/list.php
$title = 'Catalogue SF';
ob_start();
?>
<h1>Catalogue SF (<?= count($movies) ?> films)</h1>
<p><a href="index.php?page=movies&action=create">Ajouter un film</a></p>

<table>
    <tr>
        <th>Titre</th>
        <th>Réalisateur</th>
        <th>Année</th>
        <th>Genre</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($movies as $movie): ?>
        <tr>
            <td><?= htmlspecialchars($movie['title']) ?></td>
            <td><?= $movie['director_name'] ?></td>
            <td><?= $movie['release_year'] ?></td>
            <td><?= $movie['genre'] ?></td>
            <td>
                <a href="index.php?page=movies&action=show&id=<?= $movie['id'] ?>">Voir</a>
                <a href="index.php?page=movies&action=delete&id=<?= $movie['id'] ?>"
                   onclick="return confirm('Supprimer ce film ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
