<?php
// Exercice 1 Bonus : Message selon l'heure

$heure = (int) date('H');

if ($heure >= 6 && $heure < 12) {
    $salutation = 'Bonjour';
} elseif ($heure >= 12 && $heure < 18) {
    $salutation = 'Bon après-midi';
} elseif ($heure >= 18 && $heure < 22) {
    $salutation = 'Bonsoir';
} else {
    $salutation = 'Bonne nuit';
}

echo "<h1>{$salutation}, il est {$heure}h !</h1>";
