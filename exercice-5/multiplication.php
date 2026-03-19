<?php
// Exercice 5 Bonus : Table de multiplication
// Utilise des boucles for imbriquées avec une table HTML

declare(strict_types=1);
?>
<h2>Table de multiplication</h2>
<table border="1" cellpadding="4" style="border-collapse: collapse; text-align: center;">
    <tr>
        <th>&times;</th>
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <th><?= $i ?></th>
        <?php endfor; ?>
    </tr>
    <?php for ($i = 1; $i <= 10; $i++): ?>
        <tr>
            <th><?= $i ?></th>
            <?php for ($j = 1; $j <= 10; $j++): ?>
                <td><?= $i * $j ?></td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>
