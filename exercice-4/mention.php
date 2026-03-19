<?php
// Exercice 4 Bonus : Mentions selon la note
// Utilise match(true) pour gérer les tranches

declare(strict_types=1);

$note = 15;

$mention = match (true) {
    $note >= 16 => 'Très bien',
    $note >= 14 => 'Bien',
    $note >= 12 => 'Assez bien',
    $note >= 10 => 'Passable',
    default     => 'Insuffisant',
};

echo "<p>Note : {$note}/20 — Mention : {$mention}</p>";
