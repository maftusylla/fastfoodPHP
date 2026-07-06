<?php

$afficherVuePanier = function (array $panier): void {
    global $rechercherPlatParId;
    echo "\n MON PANIER \n";
    $total = 0;
    foreach ($panier as $ligne) {
        $plat = $rechercherPlatParId($ligne['id_plat']);
        if ($plat === null) continue;
        $sousTotal = $plat['prix'] * $ligne['quantite'];
        $total += $sousTotal;
        echo "{$plat['nom']} x{$ligne['quantite']} - $sousTotal CFA\n";
    }
    echo "TOTAL : $total CFA\n";
};
