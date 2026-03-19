<?php
// Exercice 5 : Tableaux et Boucles
// Partie 1 — Affichage produits
// Partie 2 — Calculs (total, filtrage)

declare(strict_types=1);

$products = [
    ['name' => 'MacBook Pro', 'price' => 2499.00, 'category' => 'tech'],
    ['name' => 'iPhone 15', 'price' => 1199.00, 'category' => 'tech'],
    ['name' => 'Clean Code', 'price' => 35.00, 'category' => 'books'],
    ['name' => 'Design Patterns', 'price' => 45.00, 'category' => 'books'],
    ['name' => 'Clavier MX Keys', 'price' => 119.00, 'category' => 'tech'],
    ['name' => 'Bureau assis-debout', 'price' => 599.00, 'category' => 'furniture'],
];

// 1. Affichage HTML avec foreach
echo '<h2>Catalogue produits</h2>';
echo '<table border="1" cellpadding="6">';
echo '<tr><th>Produit</th><th>Prix</th><th>Catégorie</th></tr>';

foreach ($products as $product) {
    $price = number_format($product['price'], 2, ',', ' ');
    echo "<tr>";
    echo "<td>{$product['name']}</td>";
    echo "<td>{$price} €</td>";
    echo "<td>{$product['category']}</td>";
    echo "</tr>";
}

echo '</table>';

// 2. Prix total avec array_reduce
$total = array_reduce(
    $products,
    fn(float $sum, array $p) => $sum + $p['price'],
    0.0
);

echo '<p>Prix total : ' . number_format($total, 2, ',', ' ') . ' €</p>';

// 3. Filtrer par catégorie
$techProducts = array_filter(
    $products,
    fn(array $p) => $p['category'] === 'tech'
);
echo '<h3>Produits tech (' . count($techProducts) . ')</h3>';
echo '<ul>';
foreach ($techProducts as $product) {
    echo "<li>{$product['name']} — " . number_format($product['price'], 2, ',', ' ') . " €</li>";
}
echo '</ul>';

// 4. Prix moyen par catégorie
$categories = array_unique(array_column($products, 'category'));
echo '<h3>Prix moyen par catégorie</h3>';
echo '<ul>';
foreach ($categories as $cat) {
    $filtered = array_filter($products, fn(array $p) => $p['category'] === $cat);
    $avg = array_sum(array_column($filtered, 'price')) / count($filtered);
    echo "<li>{$cat} : " . number_format($avg, 2, ',', ' ') . " €</li>";
}
echo '</ul>';

// 5. Tri par prix croissant
$sorted = $products;
usort($sorted, fn($a, $b) => $a['price'] <=> $b['price']);

echo '<h3>Produits triés par prix</h3>';
echo '<ol>';
foreach ($sorted as $product) {
    echo "<li>{$product['name']} — " . number_format($product['price'], 2, ',', ' ') . " €</li>";
}
echo '</ol>';
