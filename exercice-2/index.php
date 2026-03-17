<?php
// Exercice 2 : Variables et opérateurs

$prix_ht = 150.00;
$quantite = 3;
$tva = 0.20;
$reduction = 10; // en pourcentage
$client = "Entreprise ABC";

$sous_total = $prix_ht * $quantite;
$montant_reduction = $sous_total * ($reduction / 100);
$total_ht = $sous_total - $montant_reduction;
$montant_tva = $total_ht * $tva;
$total_ttc = $total_ht + $montant_tva;

echo "=== Facture pour {$client} ===" . PHP_EOL;
echo "Prix unitaire HT : " . number_format($prix_ht, 2) . " €" . PHP_EOL;
echo "Quantité : {$quantite}" . PHP_EOL;
echo "Sous-total : " . number_format($sous_total, 2) . " €" . PHP_EOL;
echo "Réduction ({$reduction}%) : -" . number_format($montant_reduction, 2) . " €" . PHP_EOL;
echo "Total HT : " . number_format($total_ht, 2) . " €" . PHP_EOL;
echo "TVA (20%) : " . number_format($montant_tva, 2) . " €" . PHP_EOL;
echo "Total TTC : " . number_format($total_ttc, 2) . " €" . PHP_EOL;