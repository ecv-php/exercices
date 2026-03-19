<?php
// Exercice 3 : Superglobales
// URL : http://localhost:8080/exercice-3/greeting.php?nom=Lison&lang=fr

if (isset($_GET['nom'])) {
    $nom = $_GET['nom'];
} else {
    $nom = 'Visiteur';
}
$nom = htmlspecialchars($nom, ENT_QUOTES, 'UTF-8');

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
} else {
    $lang = 'fr';
}

$messages = ['fr' => 'Bonjour', 'en' => 'Hello', 'es' => 'Hola', 'de' => 'Guten Tag'];

if (isset($messages[$lang])) {
    $salutation = $messages[$lang];
} else {
    $salutation = $messages['fr'];
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head><meta charset="UTF-8"><title>Bienvenue</title></head>
<body>
    <h1><?= $salutation ?>, <?= $nom ?> !</h1>
    <p>Langue : <?= $lang ?></p>
</body>
</html>
