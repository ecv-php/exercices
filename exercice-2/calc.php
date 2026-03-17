<?php
// Exercice 2 Bonus : Calculatrice
// URL : http://localhost:8080/exercice-2/calc.php?a=10&b=3&op=add

if (isset($_GET['a'])) {
    $a = (float) $_GET['a'];
} else {
    $a = 0;
}

if (isset($_GET['b'])) {
    $b = (float) $_GET['b'];
} else {
    $b = 0;
}

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = 'add';
}

if ($op === 'add') {
    $result = $a + $b;
} elseif ($op === 'sub') {
    $result = $a - $b;
} elseif ($op === 'mul') {
    $result = $a * $b;
} elseif ($op === 'div') {
    if ($b !== 0.0) {
        $result = $a / $b;
    } else {
        $result = 'Erreur: division par zéro';
    }
} elseif ($op === 'mod') {
    if ($b !== 0.0) {
        $result = $a % $b;
    } else {
        $result = 'Erreur: division par zéro';
    }
} elseif ($op === 'pow') {
    $result = $a ** $b;
} else {
    $result = 'Opération inconnue';
}

header('Content-Type: application/json');
echo json_encode([
    'a' => $a,
    'b' => $b,
    'operation' => $op,
    'result' => $result,
], JSON_PRETTY_PRINT);
