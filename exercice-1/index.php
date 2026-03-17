<?php
// Exercice 1 : Mon premier script

$nom = "Moi";
$date = date('d/m/Y');
$heure = date('H:i');
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Premier script</title></head>
<body>
    <h1>Bonjour, <?= htmlspecialchars($nom) ?> !</h1>
    <p>Nous sommes le <?= $date ?> à <?= $heure ?>.</p>
    <p>PHP <?= PHP_VERSION ?> sur <?= PHP_OS ?></p>
</body>
</html>
