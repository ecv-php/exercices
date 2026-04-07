<?php
// views/movies/show.php
$title = htmlspecialchars($movie['title']);
ob_start();
?>

<h1><?= htmlspecialchars($movie['title']) ?></h1>

<table>
    <tr><th>Année</th><td><?= $movie['release_year'] ?></td></tr>
    <tr><th>Genre</th><td><?= $movie['genre'] ?></td></tr>
</table>

<p>
    <a href="index.php?page=movies">Retour à la liste</a>
</p>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
