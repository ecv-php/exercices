<?php
// Exercice 4 : Conditions
// Partie 1 — Majeur ou Mineur
// Partie 2 — Jour de la semaine avec match

declare(strict_types=1);

// 1. Majeur ou Mineur
$age = 17;

echo "<h2>=== Statut légal ===</h2>";
echo "<p>Âge : {$age} ans — ";

if ($age >= 18) {
    echo "Majeur";
} else {
    echo "Mineur";
}

echo "</p>";

// Alternative avec ternaire
$statut = $age >= 18 ? 'Majeur' : 'Mineur';
echo "<p>Statut (ternaire) : {$statut}</p>";

// 2. Jour de la semaine avec match
$numJour = (int) date('N'); // 1 = Lundi, 7 = Dimanche

$jour = match ($numJour) {
    1 => 'Lundi',
    2 => 'Mardi',
    3 => 'Mercredi',
    4 => 'Jeudi',
    5 => 'Vendredi',
    6 => 'Samedi',
    7 => 'Dimanche',
    default => 'Numéro invalide',
};

echo "<h2>=== Jour de la semaine ===</h2>";
echo "<p>Aujourd'hui (n°{$numJour}) : {$jour}</p>";
