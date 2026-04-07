<?php
// views/movies/create.php
$title = 'Ajouter un film';
ob_start();
?>

<h1>Ajouter un film</h1>

<form method="POST">
    <div>
        <label for="title">Titre</label>
        <input type="text" id="title" name="title"
               value="<?= htmlspecialchars($old['title'] ?? '') ?>">
        <?php if (isset($errors['title'])): ?>
            <p style="color: red"><?= $errors['title'] ?></p>
        <?php endif; ?>
    </div>

    <div>
        <label for="release_year">Année</label>
        <input type="number" id="release_year" name="release_year"
               value="<?= htmlspecialchars($old['release_year'] ?? '') ?>">
        <?php if (isset($errors['release_year'])): ?>
            <p style="color: red"><?= $errors['release_year'] ?></p>
        <?php endif; ?>
    </div>

    <div>
        <label for="genre">Genre</label>
        <input type="text" id="genre" name="genre"
               value="<?= htmlspecialchars($old['genre'] ?? '') ?>">
        <?php if (isset($errors['genre'])): ?>
            <p style="color: red"><?= $errors['genre'] ?></p>
        <?php endif; ?>
    </div>

    <div>
        <label for="director_id">Réalisateur</label>
        <select id="director_id" name="director_id">
            <option value="">-- Choisir --</option>
            <?php foreach ($directors as $d): ?>
                <option value="<?= $d['id'] ?>"
                    <?= ($old['director_id'] ?? '') == $d['id'] ? 'selected' : '' ?>>
                    <?= $d['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['director_id'])): ?>
            <p style="color: red"><?= $errors['director_id'] ?></p>
        <?php endif; ?>
    </div>

    <button type="submit">Ajouter</button>
    <a href="index.php?page=movies">Annuler</a>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
