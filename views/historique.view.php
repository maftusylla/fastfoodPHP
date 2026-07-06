<?php

$afficherVueHistorique = function (array $commandes): void {
    echo "\n=== HISTORIQUE DE MES COMMANDES ===\n";
    foreach ($commandes as $commande) {
        echo "{$commande['id']} - {$commande['montant_total']} CFA - {$commande['statut']}\n";
    }
};
