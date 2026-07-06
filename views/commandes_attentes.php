<?php

$afficherVueCommandesAttente = function (array $commandesPayees, array $commandesEnPreparation): void {
    echo "\n=== COMMANDES PAYEES (a valider) ===\n";
    foreach ($commandesPayees as $commande) {
        echo "{$commande['id']} - {$commande['montant_total']} CFA\n";
    }
    echo "\n=== COMMANDES EN PREPARATION (pretes a expedier) ===\n";
    foreach ($commandesEnPreparation as $commande) {
        echo "{$commande['id']} - {$commande['montant_total']} CFA\n";
    }
};
