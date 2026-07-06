<?php

$afficherVuePaiement = function (array $commande): void {
    echo "\n=== PAIEMENT ===\n";
    echo "Commande n{$commande['id']} - Montant : {$commande['montant_total']} CFA\n";
};
