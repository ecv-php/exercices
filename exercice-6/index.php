<?php
// Exercice 6 : Fonctions
// Créer une fonction displayProducts réutilisable
// avec filtrage par catégorie et tri paramétrable

declare(strict_types=1);

$products = [
    ['name' => 'MacBook Pro', 'price' => 2499.00, 'category' => 'tech'],
    ['name' => 'iPhone 15', 'price' => 1199.00, 'category' => 'tech'],
    ['name' => 'Clean Code', 'price' => 35.00, 'category' => 'books'],
    ['name' => 'Design Patterns', 'price' => 45.00, 'category' => 'books'],
    ['name' => 'Clavier MX Keys', 'price' => 119.00, 'category' => 'tech'],
    ['name' => 'Bureau assis-debout', 'price' => 599.00, 'category' => 'furniture'],
];

function displayProducts(
    array $products,
    ?string $filterCategory = null,
    string $sortBy = 'name',
    bool $ascending = true,
): void {
    // Filtrage
    if ($filterCategory !== null) {
        $products = array_filter(
            $products,
            fn($p) => $p['category'] === $filterCategory
        );
    }

    // Tri
    usort($products, function ($a, $b) use ($sortBy, $ascending) {
        $comparison = $a[$sortBy] <=> $b[$sortBy];
        return $ascending ? $comparison : -$comparison;
    });

    // Affichage
    if (empty($products)) {
        echo "<p>Aucun produit trouvé.</p>";
        return;
    }

    echo "<ul>";
    foreach ($products as $product) {
        $price = number_format($product['price'], 2, ',', ' ');
        echo "<li>{$product['name']} — {$price} € <em>({$product['category']})</em></li>";
    }
    echo "</ul>";
}

// Tous les produits, triés par nom
echo '<h2>Tous les produits (par nom)</h2>';
displayProducts($products);

// Produits tech, triés par prix décroissant
echo '<h2>Produits tech (prix décroissant)</h2>';
displayProducts($products, filterCategory: 'tech', sortBy: 'price', ascending: false);

// Livres, triés par prix croissant
echo '<h2>Livres (prix croissant)</h2>';
displayProducts($products, filterCategory: 'books', sortBy: 'price');

// Catégorie inexistante
echo '<h2>Catégorie "food"</h2>';
displayProducts($products, filterCategory: 'food');
