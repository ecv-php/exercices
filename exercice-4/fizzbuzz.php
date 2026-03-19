<?php
// Exercice 4 Bonus : FizzBuzz
// Affiche les nombres de 1 à 100 :
//   - "Fizz"     pour les multiples de 3
//   - "Buzz"     pour les multiples de 5
//   - "FizzBuzz" pour les multiples de 15
//   - Le nombre  sinon

declare(strict_types=1);

echo "<h2>=== FizzBuzz ===</h2><p>";

for ($i = 1; $i <= 100; $i++) {
    $output = match (true) {
        $i % 15 === 0 => '<strong>FizzBuzz</strong>',
        $i % 3 === 0  => 'Fizz',
        $i % 5 === 0  => 'Buzz',
        default       => (string) $i,
    };

    echo $output . ' ';
}

echo "</p>";
