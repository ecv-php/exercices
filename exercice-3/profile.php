<?php
// Exercice 3 Bonus : Page de profil
// URL : http://localhost:8080/exercice-3/profile.php?name=Alice&age=25&skills=php,js,python&theme=dark

$errors = [];

// Validation du nom
if (isset($_GET['name']) && trim($_GET['name']) !== '') {
    $name = htmlspecialchars(trim($_GET['name']), ENT_QUOTES, 'UTF-8');
} else {
    $errors[] = 'Le nom est requis';
    $name = '';
}

// Validation de l'âge
if (isset($_GET['age']) && is_numeric($_GET['age'])) {
    $age = (int) $_GET['age'];
    if ($age < 18 || $age > 120) {
        $errors[] = 'L\'âge doit être entre 18 et 120';
    }
} else {
    $errors[] = 'L\'âge est requis et doit être un nombre';
    $age = 0;
}

// Skills : "php,js" → tableau ['php', 'js']
$skills = [];
if (isset($_GET['skills'])) {
    $parts = explode(',', $_GET['skills']);
    foreach ($parts as $part) {
        $part = trim($part);
        if ($part !== '') {
            $skills[] = htmlspecialchars($part, ENT_QUOTES, 'UTF-8');
        }
    }
}

// Thème par whitelist
$themes_ok = ['dark', 'light'];
if (isset($_GET['theme']) && in_array($_GET['theme'], $themes_ok, true)) {
    $theme = $_GET['theme'];
} else {
    $theme = 'light';
}

if ($theme === 'dark') {
    $bg = '#1e1e2e';
    $color = '#cdd6f4';
} else {
    $bg = '#ffffff';
    $color = '#1e293b';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <style>
        body { font-family: Helvetica, Arial, sans-serif; background: <?= $bg ?>; color: <?= $color ?>; padding: 20px; }
        .error { color: red; }
        .skill { display: inline-block; background: #2563eb; color: white; padding: 2px 8px; border-radius: 4px; margin: 2px; }
    </style>
</head>
<body>
    <?php if (!empty($errors)): ?>
        <div class="error">
            <h2>Erreurs</h2>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <h1><?= $name ?></h1>
        <p>Âge : <?= $age ?> ans</p>
        <p>Compétences :
            <?php foreach ($skills as $skill): ?>
                <span class="skill"><?= $skill ?></span>
            <?php endforeach; ?>
        </p>
    <?php endif; ?>
</body>
</html>
