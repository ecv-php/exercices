<?php
// Exercice 10 : Connexion PDO
declare(strict_types=1);

function getConnection(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $pdo = new PDO(
            'mysql:host=exercices-mysql-1;dbname=ecv;charset=utf8mb4',
            'ecv', 'ecv',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }

    return $pdo;
}
